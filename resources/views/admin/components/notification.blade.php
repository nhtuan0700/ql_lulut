<li class="nav-item dropdown" id="notification">
  <a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <div id="count_unread"></div>
  </a>
  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right list-notification">
    <span class="dropdown-item dropdown-header">Thông báo</span>
    <div class="dropdown-divider"></div>
    <div class="content">
      <div class="content-body">

      </div>
      <div class="content-footer">

      </div>
    </div>
  </div>
</li>
@push('js')
  <script src="//{{ request()->getHost() }}:6001/socket.io/socket.io.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    $(function() {
      var title = `{{ config('app.name') }}`;
      var data = {
        page: 1
      };
      var count_unread = 0;
      const url_list = `{{ route('notification.list') }}`;
      const url_mark_read = `{{ route('notification.mark_read') }}`;
      const userId = `{{ auth()->id() }}`;
      loadNotify(url_list, data);
      $('#notification').on('show.bs.dropdown', function() {
        if (count_unread > 0) {
          $.ajax({
            url: url_mark_read,
            success: function(result) {
              if (result.success) {
                count_unread = 0;
                document.title = title;
                $('#count_unread').html(getCountUnreadHTML(count_unread))
              }
            }
          })
        }
      });

      Echo.private('App.Models.User.' + userId).notification((data) => {
        count_unread += 1;
        let notification = {
          message: data.message,
          created_at: data.created_at,
          path: data.path
        }
        $('#no_notification').remove();
        $('#count_unread').html(getCountUnreadHTML(count_unread));
        document.title = `(${count_unread}) ${title}`;
        $('#notification .content-body').prepend(getNotificationItemHTML(notification));
      })

      function loadNotify(url, data) {
        $.ajax({
          url: url,
          data: data,
          success: function(result) {
            if (result.success) {
              var notifications = result.notifications.data;
              count_unread = result.count_unread;
              if (data.page == 1 && notifications.length == 0) {
                let msg_no_notify =
                  '<p class="text-center text-danger" id="no_notification">Không có thông báo</p>';
                $('#notification .content-body').html(msg_no_notify);
                return;
              }

              var htmlNotifications = notifications.map(function(item) {
                let notification = {
                  message: item.data.message,
                  created_at: item.created_at,
                  path: item.data.path
                }
                return getNotificationItemHTML(notification);
              }).join('');
              $('#count_unread').html(getCountUnreadHTML(count_unread));
              $('#notification .content-body').append(htmlNotifications);
              data.page += 1;
              if (data.page <= result.lastPage) {
                let loadMoreButton =
                  `<button type="button" class="dropdown-item dropdown-footer"
                    id="read-more">Xem thêm</button>`;
                $('#notification .content-footer').html(loadMoreButton)
                $('#read-more').click(function(e) {
                  e.stopPropagation();
                  loadNotify(url, data)
                })
              } else {
                $('#notification .content-footer').html('')
              }
            }
          }
        })
      }

      function getCountUnreadHTML(count) {
        if (count > 0) {
          document.title = `(${count}) ${title}`;
          return `<span class="badge badge-warning navbar-badge">${count}</span>`;
        }
        return '';
      }

      function getNotificationItemHTML(notification) {
        return `<a title="${notification.message}" href="${notification.path || '#'}" class="dropdown-item d-block">
                <p class="notification-content">
                  ${notification.message}  
                </p>
                <span class="text-muted text-sm">
                  ${notification.created_at}
                </span>
              </a>
              <div class="dropdown-divider"></div>`;
      }
    })
  </script>
@endpush
