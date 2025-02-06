<?php $flashing = false; ?>
@if (session('success'))
    <?php $flashing = true; ?>
    <div class="alert alert-success alert-fixed">
        <div class="alert-content">
            <i class="left-icon"></i>
            <div>
                <p class="mil-bold">Success</p>
                <p>{!! session('success') !!}</p>
            </div>
        </div>
        <button type="button" class="cancel-icon">
    </div>
@elseif (session('warning'))
    <?php $flashing = true; ?>
    <div class="alert alert-warning alert-fixed">
        <div class="alert-content">
            <i class="left-icon"></i>
            <div>
                <p class="mil-bold">Warning</p>
                <p>{!! session('warning') !!}</p>
            </div>
        </div>
        <button type="button" class="cancel-icon">
    </div>
@elseif (session('error'))
    <?php $flashing = true; ?>
    <div class="alert alert-danger alert-fixed">
        <div class="alert-content">
            <i class="left-icon"></i>
            <div>
                <p class="mil-bold">Error</p>
                <p>{!! session('error') !!}</p>
            </div>
        </div>
        <button type="button" class="cancel-icon">
    </div>
@elseif ($errors->any())
    <?php $flashing = true; ?>
    <div class="alert alert-danger alert-fixed">
        <div class="alert-content">
            <i class="left-icon" alt="success"></i>
            <div>
                <p class="mil-bold">Invalid Input</p>
                <ul style="list-style-position: inside; list-style-type: '-&nbsp;&nbsp;';">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button type="button" class="cancel-icon">
    </div>
@endif

@if ($flashing)
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('.alert .cancel-icon').on('click', function() {
                $(this).closest('.alert').fadeOut(200, function() { $(this).remove() });
            });

            setTimeout(() => {
                $('.alert .cancel-icon')[0].click();
            }, 4000);
        });
    </script>
@endif
