<style>
    /* ------------------------------------------- */

    /* ---------------- Custom Alert ----------------- */

    /* ------------------------------------------- */

    :root {
        --url-cancel: url('{{ asset('img/icons/cancel.svg') }}');
        --url-checklist: url('{{ asset('img/icons/checklist.svg') }}');
        --url-danger: url('{{ asset('img/icons/danger.svg') }}');
        --url-warning: url('{{ asset('img/icons/warning.svg') }}');
        --url-report-success: url('{{ asset('img/icons/checklist.svg') }}');
    }

    .alert-fixed {
        position: fixed;
        right: min(3vw, 2rem);
        bottom: 2rem;
    }

    .alert {
        min-width: 380px;
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        border: 2px solid;
        border-radius: 5px;
        z-index: 99 !important;

        .alert-content {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .left-icon {
            width: 34px;
            height: 34px;
            display: block;
            background-repeat: no-repeat;
            background-size: cover;
        }

        & p,
        li {
            text-align: start;
            max-width: min(600px, 60vw);
            line-height: 20px;
        }

        & p.mil-bold {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        & p:not(.mil-bold) {
            margin-bottom: 0;
        }

        .cancel-icon {
            width: 2rem;
            height: 2rem;
            border: none;
            background-color: transparent;

            cursor: pointer;
            filter: brightness(0) saturate(100%) invert(43%) sepia(17%) saturate(18%) hue-rotate(37deg) brightness(101%) contrast(90%);
            /* align-self: baseline; */

            background-image: var(--url-cancel);
            background-repeat: no-repeat;
            background-size: cover;

            &:hover {
                filter: brightness(0);
            }
        }
    }

    .alert-success {
        background-image: unset !important;
        background-color: #DEF2D6;
        border-color: #63775B;

        .left-icon {
            background-image: var(--url-checklist);
        }

        & p,
        li {
            color: #63775B;
        }
    }

    .alert-danger {
        background-image: unset !important;
        background-color: #EBC8C4;
        border-color: #9B4244;
        animation: shake 0.6s linear 1;

        .left-icon {
            background-image: var(--url-danger);
        }

        & p,
        li {
            color: #9B4244;
        }
    }

    .alert-warning {
        background-image: unset !important;
        background-color: #F8F3D6;
        border-color: #847147;

        .left-icon {
            background-image: var(--url-warning);
        }

        & p,
        li {
            color: #847147;
        }
    }

    .top-alert {
        position: fixed;
        top: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 35px;
        z-index: 99999 !important;

        .left-icon {
            width: 34px;
            height: 34px;
            display: block;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        &.top-alert-success {
            background-color: #4CAF50;
            color: white;

            .left-icon {
                background-image: var(--url-report-success);
                filter: brightness(0) saturate(100%) invert(100%) sepia(0%) saturate(0%) hue-rotate(140deg) brightness(103%) contrast(108%);
            }
        }

        .alert-content {
            display: flex;
            gap: 7px;
            margin-left: auto;

            p {
                display: flex;
                align-items: center;
                font-family: 'Poppins';
                font-size: 20px;
                font-weight: 500;
            }
        }

        .cancel-icon {
            width: 2rem;
            height: 2rem;
            border: none;
            background-color: transparent;
            margin-left: auto;

            cursor: pointer;
            /* align-self: baseline; */

            background-image: var(--url-cancel);
            background-repeat: no-repeat;
            background-size: cover;
            filter: brightness(0) saturate(100%) invert(100%) sepia(0%) saturate(0%) hue-rotate(140deg) brightness(103%) contrast(108%);

            &:hover {
                filter: brightness(0);
            }
        }

        button {
            align-self: flex-end;
        }
    }

    @keyframes shake {
        0%,100% {
            transform: translateX(0);
        }
        10%, 30%, 50%, 70%, 90% {
            transform: translateX(-10px);
        }
        20%, 40%, 60%, 80% {
            transform: translateX(10px);
        }
    }
</style>

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
@elseif (session('report-success'))
    <?php $flashing = true; ?>
    <div class="top-alert top-alert-success">
        <div class="alert-content">
            <i class="left-icon"></i>
            <p>{!! session('report-success') !!}</p>
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
                $(this).closest('.alert').fadeOut(300, function() {
                    $(this).remove()
                });
            });

            $('.top-alert .cancel-icon').on('click', function() {
                $(this).closest('.top-alert').fadeOut(300, function() {
                    $(this).remove()
                });
            });

            setTimeout(() => {
                $('.alert .cancel-icon')[0]?.click();
            }, 4000);

            setTimeout(() => {
                $('.top-alert .cancel-icon')[0]?.click();
            }, 4000);
        });
    </script>
@endif
