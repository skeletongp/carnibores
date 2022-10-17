<div class="fixed {{$positionCss}} @if($hideOnClick) cursor-pointer @endif"
    x-data="{show: false, timeout: null, duration: null}"
    @if($message)
        x-init="() => { duration = @this.duration; clearTimeout(timeout); show = true;
                if( duration > 0 ) {timeout = setTimeout(() => { show = false }, duration); }}"
    @endif
    @new-toast.window="duration = @this.duration; clearTimeout(timeout); show = true;
                if( duration > 0 ) { timeout = setTimeout(() => { show = false }, duration); }"
    @click="if(@this.hideOnClick) { show = false; }"
    x-show="show"

    @if($transition)
        x-transition:enter="transition ease-in-out duration-300" 
        x-transition:enter-start="opacity-0 transform {{$this->transitioClasses['enter_start_class']}}" 
        x-transition:enter-end="opacity-100 transform {{$this->transitioClasses['enter_end_class']}}" 
        x-transition:leave="transition ease-in-out duration-500" 
        x-transition:leave-start="opacity-100 transform {{$this->transitioClasses['leave_start_class']}}"
        x-transition:leave-end="opacity-0 transform {{$this->transitioClasses['leave_end_class']}}"
    @endif
>
    @if($message)
        <div class="flex {{$bgColorCss}} border-l-4 {{$borderColorCss}} py-2 px-3 shadow-md mb-2 ">
            <!-- icons -->
            @if($showIcon)
                <div class="{{$iconColorCss}} rounded-full {{$iconBgColorCss}} mr-3">
                    @include('livewire.toast.icons.' . $type)
                </div>
            @endif
            <!-- message -->
            <div class="{{$textColorCss}} max-w-xs ">
                {{$message}}
            </div>
        </div>
    @endif
</div>
