<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate-System</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">

</head>

<body>

    <!-- Loading -->
    <x-loading :loadingId="'preloader'" />


    @include('layouts.partials.nav')

    @if (auth()->check() && auth()->user()->notifications->isNotEmpty())
        <div class="notification-container">
            @foreach (auth()->user()->unreadNotifications as $notification)
                <div class="alert alert-info notification-alert animate__animated animate__fadeInRight"
                    data-id="{{ $notification->id }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $notification->data['message'] }}</strong>
                        </div>
                        <button type="button"
                            class="btn btn-success btn-sm mark-as-read-button animate__animated animate__pulse">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @yield('content') @include('layouts.partials.footer')

    <!-- Bootstrap Scripts -->
    <x-script-bootstrab />

    <!-- Notification AJAX -->
    <script>
        $(document).ready(function() {
            $('.mark-as-read-button').on('click', function() {
                const notificationId = $(this).closest('.notification-alert').data('id');

                $.ajax({
                    url: '{{ url('/notifications/read') }}/' + notificationId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $('.notification-alert[data-id="' + notificationId + '"]').addClass(
                            'animate__fadeOutRight');

                        setTimeout(function() {
                            $('.notification-alert[data-id="' + notificationId + '"]')
                                .fadeOut();
                        }, 500);
                    },
                    error: function(xhr) {
                        console.error('Error marking notification as read:', xhr.responseText);
                    }
                });
            });
        });
    </script>

    <!-- Loading Screen Script -->
    <script src="{{ asset('js/loadingall.js') }}"></script>

</body>

</html>
