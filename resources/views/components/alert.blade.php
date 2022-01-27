<div {{$attributes->merge(['class'=>'alert alert-'.$type.' '.$margin,'title'=>'','aa'=>' '])}}>
    {{$slot}}

        @if($isCloseAble())
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif

    {{$getDateTime()}}
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
</div>
