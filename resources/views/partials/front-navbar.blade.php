<style>
    .modal-dialog p,
    .modal-dialog h2,
    .modal-dialog strong,
    .modal-dialog li,
    .modal-dialog h3,
    .modal-dialog h5,
    .modal-dialog span {
        font-family: "Cairo", sans-serif !important;
        text-align: justify !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-center" style="margin-top: 70px;">
    <ul class="navbar-nav" id="top-nav-links">
        <li class="nav-item">
            <a class="btn btn-primary mx-1" data-toggle="modal" data-target="#Terms-And-Conditions" href="#">{{ __('Terms And Conditions') }}</a>
        </li>
        <li class="nav-item">
            <a class="btn btn-primary mx-1" data-toggle="modal" data-target="#Refund-Policy" href="#">{{ __('Refund Policy') }}</a>
        </li>
        <li class="nav-item">
            <a class="btn btn-primary mx-1" data-toggle="modal" data-target="#Privacy-Policy" href="#">{{ __('Privacy Policy') }}</a>
        </li>
    </ul>
</nav>

<!-- مودال الشروط والأحكام -->
<div class="modal fade" id="Terms-And-Conditions" tabindex="-1" role="dialog" aria-labelledby="Terms-And-Conditions" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Terms And Conditions') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! __('Terms And Conditions Text') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- مودال سياسة الاسترداد -->
<div class="modal fade" id="Refund-Policy" tabindex="-1" role="dialog" aria-labelledby="Refund-Policy" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Refund Policy') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! __('Refund Policy Text') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- مودال سياسة الخصوصية -->
<div class="modal fade" id="Privacy-Policy" tabindex="-1" role="dialog" aria-labelledby="Privacy-Policy" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Privacy Policy') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! __('Privacy Policy Text') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
