<?php

namespace App\View\Components\NoonPost;

use Illuminate\View\Component;

class Header extends Component
{

    public function render()
    {
        return $this->view('components.noon-post.header');
    }
}
