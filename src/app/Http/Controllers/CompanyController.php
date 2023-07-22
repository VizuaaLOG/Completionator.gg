<?php

namespace App\Http\Controllers;

use Log;
use Throwable;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\CompanyService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Companies\CreateCompanyRequest;
use App\Http\Requests\Companies\UpdateCompanyRequest;

class CompanyController extends Controller
{
    public function __construct(
        protected readonly CompanyService $companyService,
    )
    {
    }

    public function index(Request $request): View
    {
        return view('companies.index', [
            'companies' => $this->companyService->paginated(),
        ]);
    }

    public function create() {
        return view('companies.form');
    }

    public function store(CreateCompanyRequest $request): RedirectResponse
    {
        try {
            $this->companyService->create($request->all());

            return redirect()
                ->route('companies.index')
                ->with('success', "Company \"{$request->get('name')}\" has been created.");
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'message' => 'Error occurred while creating the company. Try again, or check the logs if this persists.',
                ]);
        }
    }

    public function show(Company $company): View
    {
        return view('companies.show', [
            'company' => $company,
        ]);
    }

    public function edit(Company $company) {
        return view('companies.form', [
            'company' => $company,
        ]);
    }

    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        try {
            $this->companyService->update($company, $request->all());

            return redirect()
                ->route('companies.show', ['company' => $company])
                ->with('success', "Company updated.");
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'message' => 'Error occurred while updating the company. Try again, or check the logs if this persists.',
                ]);
        }
    }

    public function destroy(Request $request, Company $company): RedirectResponse
    {
        try {
            $this->companyService->delete($company);
        } catch (Throwable $e) {
            Log::error($e);
        }

        return redirect()->route('companies.index');
    }
}
