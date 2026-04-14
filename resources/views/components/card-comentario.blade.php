<div class="card card-comentario shadow-sm h-100">
    <div class="card-body">

        <h5 class="card-title">
            {{ $titulo }}
        </h5>

        <p class="card-text">
            {{ $texto }}
        </p>

        <div class="rating">
            @for($i = 1; $i <= 5; $i++)
                <i class="bi {{ $i <= $rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
            @endfor
        </div>

    </div>
</div>