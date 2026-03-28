<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyFilterRequest;
use App\Services\CompanyService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function __construct(
        protected CompanyService $repo
    ) {}

    public function index(CompanyFilterRequest $request): View
    {
        $companies  = $this->repo->search($request->filters());
        $industries = $this->repo->getAllIndustries();

        return view('pages.public.companies.index', [
            'companies'  => $companies,
            'filters'    => $request->filters(),
            'industries' => $industries,
            'totalCount' => $companies->total(),
            'sizes'      => ['1-10', '11-50', '51-200', '201-500', '500+'],
        ]);
    }

    public function show(string $slug): View|RedirectResponse
    {
        try {
            $company     = $this->repo->getBySlug($slug);
            $isFollowing = $this->repo->isFollowing($company);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('companies.index')
                ->with('error', 'Company not found.');
        }

        return view('pages.public.companies.show', compact('company', 'isFollowing'));
    }

    public function follow(string $slug): RedirectResponse
    {
        try {
            $company  = $this->repo->getBySlug($slug);
            $following = $this->repo->toggleFollow($company);
            $message   = $following ? 'Now following ' . $company->name : 'Unfollowed ' . $company->name;
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong.');
        }

        return back()->with('success', $message);
    }
}
