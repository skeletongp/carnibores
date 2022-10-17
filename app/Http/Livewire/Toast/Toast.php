<?php

namespace App\Http\Livewire\Toast;

use Livewire\Component;

class Toast extends Component
{
    protected $listeners = ['show', 'showWarning', 'showError', 'showInfo', 'showSuccess'];
    public $message;
    public $type;
    public $positionCss;
    public $bgColorCss;
    public $borderColorCss;
    public $textColorCss;
    public $iconColorCss;
    public $iconBgColorCss;
    public $duration;
    public $showIcon;
    public $hideOnClick;
    public $transition;
    public $transitioClasses;

    protected $transitions = [
        'rotate' => ['rotate-180', 'rotate'],
        'zoom_in' => ['scale-50', 'scale-100'],
        'appear_from_right' => ['translate-x-1/2', 'translate-x-0'],
        'appear_from_left' => ['-translate-x-1/2', 'translate-x-0'],
        'appear_from_below' => ['translate-y-1/2', 'translate-y-0'],
        'appear_from_above' => ['-translate-y-1/2', 'translate-y-0'],
    ];

    public function mount()
    {
        if($message = session('toast')) {
            $this->show($message);
        }
    }

    public function show($params)
    {
        $type = '';
        if (is_array($params)) {
            $this->message = $params['message'] ?? '';
            $type = $params['type'] ?? '';
        } else {
            $this->message = $params;
        }
        $this->_setType($type);
    }

    public function showWarning($message)
    {
        $this->message = $message;
        $this->_setType('warning');
    }

    public function showInfo($message)
    {
        $this->message = $message;
        $this->_setType('info');
    }

    public function showError($message)
    {
        $this->message = $message;
        $this->_setType('error');
    }

    public function showSuccess($message)
    {
        $this->message = $message;
        $this->_setType('success');
    }

    public function render()
    {
        $this->_setBackgroundColor();
        $this->_setTextColor();
        $this->_setBorderColor();
        $this->_setIconColor();
        $this->_setIconBgColor();
        $this->_setPosition();
        $this->_setDuration();
        $this->_setIcon();
        $this->_setClickHandler();
        $this->_setTransition();
        
        if (!empty($this->message)) {
            $this->dispatchBrowserEvent('new-toast');
        }
        return view('livewire.toast.toast');
    }

    private function _setType($type = '')
    {
        if (in_array($type, ['warning', 'info', 'error', 'success'])) {
            $this->type = $type;
        } else {
            $this->type = config('toast.type');
        }
    }

    private function _setBackgroundColor()
    {
        $this->bgColorCss = config('toast.color.bg.' . $this->type);
    }
    private function _setBorderColor()
    {
        $this->borderColorCss = config('toast.color.border.' . $this->type);
    }

    private function _setTextColor()
    {
        $this->textColorCss = config('toast.text_color');
    }
    private function _setIconColor()
    {
        $this->iconColorCss = config('toast.color.icon.' . $this->type);
    }

    private function _setIconBgColor()
    {
        $this->iconBgColorCss = config('toast.color.icon_bg.' . $this->type);
    }

    private function _setPosition()
    {
        switch (config('toast.position')) {
            case 'top-left':
                $this->positionCss = 'top-4 left-4';
                break;
            case 'top-right':
                $this->positionCss = 'top-4 right-4';
                break;
            case 'bottom-left':
                $this->positionCss = 'bottom-4 left-4';
                break;
            case 'bottom-right':
            default:
                $this->positionCss = 'bottom-4 right-4';
        }
    }

    private function _setDuration()
    {
        $this->duration = (int)config('toast.duration');
    }

    private function _setIcon()
    {
        $this->showIcon = (boolean)config('toast.show_icon');
    }

    private function _setClickHandler()
    {
        $this->hideOnClick = (boolean)config('toast.hide_on_click');
    }

    private function _setTransition()
    {
        $this->transition = (boolean)config('toast.transition');
        if ($this->transition) {
            $this->transitioClasses['leave_end_class'] =
            $this->transitioClasses['enter_start_class'] =
            reset($this->transitions[config('toast.transition_type')]);

            $this->transitioClasses['leave_start_class'] =
            $this->transitioClasses['enter_end_class'] =
            end($this->transitions[config('toast.transition_type')]);
        }
    }
}
