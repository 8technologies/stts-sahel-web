<?php

namespace App\Admin\Controllers;

use App\Models\LoadStock;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Database\Administrator;
use \App\Models\SeedLab;
use \App\Models\CropDeclaration;
use \App\Models\CropVariety;
use \App\Models\Crop;


class FeedBackController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Feedback';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new SeedLab());
       //check if the user has any seed labs with a test decision thats not null
        $user = Admin::user();
        $seed_labs = SeedLab::where('applicant_id', $user->id)->whereNotNull('test_decision')->get();
        //if the user has no seed labs with a test decision thats not null disable the create button
        if($seed_labs->isEmpty()){
            $grid->disableCreateButton();
        }
  
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(SeedLab::findOrFail($id));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SeedLab());

       //get all lot numbers of the user from the seedlab table
        $user = Admin::user();

        $seed_labs = SeedLab::where('applicant_id', $user->id)->get();
        $lot_numbers_array = [];
        foreach($seed_labs as $seed_lab){
            $lot_numbers_array[$seed_lab->id] = $seed_lab->lot_number;
        }
        //dd($lot_numbers);
        $form->select('lot_number', __('Lot Number'))->options($lot_numbers_array)->attribute('id', 'lot_number');;
        $form->display('', __('Crop'))->attribute('id', 'crop');
        $form->display('', __('Variety'))->attribute('id', 'crop-variety');
        $form->display('', __('Generation'))->attribute('id', 'generation');
        $form->textarea('remarks', __('Enter remarks'));
    
    Admin::script('
    $(document).ready(function() {
        $("#lot_number").change(function() {
            var lotId = $(this).val();
            
            $.ajax({
                url: "/feedback/" + lotId,
                method: "GET",
                success: function(data) {
                    var cropVarieties = $("#crop-variety");
                    var crop = $("#crop");
                    var generation = $("#generation");

                    crop.val(data.crop);
                    generation.val(data.generation);
                    cropVarieties.val(data.crop_variety);
                   
                }
            });
        });
    });
    ');
       
     
        return $form;
    }


    public function feedbackDetails($lotId)
    {
        $seedLab = SeedLab::find($lotId);
    
        if (!$seedLab) {
            return response()->json(null);
        }
    
        $loadStock = LoadStock::where('id', $seedLab->load_stock_id)
            ->where('applicant_id', $seedLab->applicant_id)
            ->first();
    
        if (!$loadStock) {
            return response()->json(null);
        }
    
        $crop_declaration = $loadStock->crop_declaration_id;
    
        if (!$crop_declaration) {
            return response()->json(null);
        }
    
        $crop_variety_id = CropDeclaration::where('id', $crop_declaration)
            ->value('crop_variety_id');
    
        if (!$crop_variety_id) {
            return response()->json(null);
        }
    
        $crop_variety = CropVariety::where('id', $crop_variety_id)
            ->first();
    
        if (!$crop_variety) {
            return response()->json(null);
        }
    
        $crop = Crop::where('id', $crop_variety->crop_id)
            ->value('crop_name');
    
        if (!$crop) {
            return response()->json(null);
        }
    
        $data = [
            'crop' => $crop,
            'generation' => $crop_variety->crop_variety_generation,
            'crop_variety' => $crop_variety->crop_variety_name,
        ];
    
        return response()->json($data);
    }
    
    
}
