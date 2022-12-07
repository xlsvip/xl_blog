<?php

namespace App\Http\Livewire;

use App\Models\PostModel;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;
    /**
     * @var string
     */
    public $search = '';

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var array
     */
//    protected $queryString = ['search'];
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    /**
     * 初始化.
     */
    public function mount(): void
    {
        $this->fill(request()->only('search', 'page'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|View
     */
    public function render()
    {
        $posts = $this->search ? PostModel::where('title', 'like', '%'.$this->search.'%')->paginate(5) : [];

        return view('livewire.search', [
            'posts' => $posts,
        ]);
    }
}
