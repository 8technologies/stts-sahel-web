<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="icon-bell"></i>
    @if (count($notifications) > 0)
      <span class="badge bg-danger">{{ count($notifications) }}</span>
    @endif
  </a>
  <ul class="dropdown-menu" aria-labelledby="notificationsDropdown">
    <li class="dropdown-header">You have {{ count($notifications) }} pending tasks.</li>
    <li>
      <ul class="list-unstyled">
        @foreach ($notifications as $n)
          <li>
            <a class="dropdown-item notify" href="{{ $n->form_link }}" title="{{ $n->message }}">
              @if ($n->receiver_id == null)
                <i class="fa fa-users text-success"></i>
              @else
                <i class="fa fa-user text-success"></i>
              @endif
              <span class="message-text">{{ $n->message }}</span>
            </a>
          </li>
        @endforeach
      </ul>
    </li>
  </ul>
</li>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const notifyLinks = document.querySelectorAll('.notify');
    notifyLinks.forEach(function (link) {
      link.addEventListener('mouseover', function () {
        const messageSpan = this.querySelector('.message-text');
        messageSpan.style.whiteSpace = 'normal';
        messageSpan.style.overflow = 'visible';
        messageSpan.style.textOverflow = 'unset';
      });

      link.addEventListener('mouseout', function () {
        const messageSpan = this.querySelector('.message-text');
        messageSpan.style.whiteSpace = 'nowrap';
        messageSpan.style.overflow = 'hidden';
        messageSpan.style.textOverflow = 'ellipsis';
      });
    });
  });
</script>
