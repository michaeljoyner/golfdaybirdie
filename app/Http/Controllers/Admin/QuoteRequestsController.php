<?php

namespace App\Http\Controllers\Admin;

use App\Quotes\QuoteRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuoteRequestsController extends Controller
{
    public function index()
    {
        $quoteRequests = QuoteRequest::where('archived', 0)->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.quotes.index')->with(compact('quoteRequests'));
    }

    public function show($id)
    {
        $quoteRequest = QuoteRequest::with('products', 'images')->findOrFail($id);

        return view('admin.quotes.show')->with(compact('quoteRequest'));
    }
}
