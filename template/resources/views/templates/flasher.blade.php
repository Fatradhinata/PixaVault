<?php $flashing = false ?>
@if (session('success'))
    <?php $flashing = true ?>
    <div class="alert alert-success alert-dismissible fade show position-fixed" style="bottom: 0.5rem; right: 1.5rem; z-index: 99;" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('warning'))
    <?php $flashing = true ?>
    <div class="alert alert-warning alert-dismissible fade show position-fixed" style="bottom: 0.5rem; right: 1.5rem; z-index: 99;" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('error'))
    <?php $flashing = true ?>
    <div class="alert alert-danger alert-dismissible fade show position-fixed" style="bottom: 0.5rem; right: 1.5rem; z-index: 99;" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif ($errors->any())
    <?php $flashing = true ?>
    <div class="alert alert-danger alert-dismissible fade show position-fixed" style="bottom: 0.5rem; right: 1.5rem; z-index: 99; display: flex;" role="alert">
        {{-- Data cannot be empty! --}}
        <ul class="ms-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($flashing)
    <script>
        document.addEventListener('DOMContentLoaded', () => {setTimeout(() => {document.querySelector('div.alert.alert-dismissible > button').click()}, 4000)})
    </script>
@endif
