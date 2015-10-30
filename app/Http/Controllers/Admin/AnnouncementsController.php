<?php

namespace App\Http\Controllers\Admin;

use App\Announcement;
use App\Http\FlashMessages\Flasher;
use App\Http\Requests\AnnouncementFormRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AnnouncementsController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function index()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->get();

        return view('admin.announcements.index')->with(compact('announcements'));
    }

    public function create()
    {
        $announcement = new Announcement();

        return view('admin.announcements.create')->with(compact('announcement'));
    }

    public function store(AnnouncementFormRequest $request)
    {
        Announcement::create($request->only(['title', 'body', 'subscript']));

        $this->flasher->success('Announcement Created', 'Hear ye, hear ye, it has been said.');

        return redirect('admin/announcements');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);

        return view('admin.announcements.edit')->with(compact('announcement'));

    }

    public function update(AnnouncementFormRequest $request, $id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->update($request->only(['title', 'body', 'subscript']));

        $this->flasher->success('Announcement Updated', 'Saving you time, saving you money, putting you first');

        return redirect('admin/announcements');
    }

    public function delete($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        $this->flasher->success('Announcement deleted', 'You shall never see the likes of that again.');

        return redirect('admin/announcements');
    }
}
