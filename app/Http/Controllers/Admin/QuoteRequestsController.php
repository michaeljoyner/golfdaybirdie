<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessages\Flasher;
use App\Quotes\QuoteRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuoteRequestsController extends Controller
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
        $quoteRequests = QuoteRequest::where('archived', 0)->orderBy('updated_at', 'desc')->paginate(5);
        $isArchives = false;

        return view('admin.quotes.index')->with(compact('quoteRequests', 'isArchives'));
    }

    public function archivesIndex()
    {
        $quoteRequests = QuoteRequest::where('archived', 1)->orderBy('updated_at', 'desc')->paginate(5);
        $isArchives = true;

        return view('admin.quotes.index')->with(compact('quoteRequests', 'isArchives'));
    }

    public function show($id)
    {
        $quoteRequest = QuoteRequest::with('products', 'images')->findOrFail($id);

        return view('admin.quotes.show')->with(compact('quoteRequest'));
    }

    public function archive($id)
    {
        $quoteRequest = QuoteRequest::findOrFail($id);
        $archiveStatus = $quoteRequest->archived ? 0 : 1;
        $quoteRequest->update(['archived' => $archiveStatus]);

        if($archiveStatus) {
            $this->flasher->success('Stashed away!', 'The quote request has been archived');
        } else {
            $this->flasher->success('I am back baby!', 'The archived request has been returned');
        }


        return redirect()->to('/admin/quoterequests');
    }

    public function delete($id)
    {
        $quoteRequest = QuoteRequest::findOrFail($id);
        $quoteRequest->delete();

        $this->flasher->success('All gone!', 'That quote request has been deleted.');

        return redirect()->to('/admin/quoterequests');

    }
}
