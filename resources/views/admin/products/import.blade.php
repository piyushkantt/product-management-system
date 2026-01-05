@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Import Products</h5>
            </div>

            <div class="card-body">

                <p class="text-muted">
                    Upload a CSV or Excel file to import products in bulk.
                </p>

                <form
                    method="POST"
                    action="{{ route('admin.products.import') }}"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Select File</label>
                        <input
                            type="file"
                            name="file"
                            class="form-control @error('file') is-invalid @enderror"
                            accept=".csv,.xlsx"
                            required
                        >

                        @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.products.index') }}"
                           class="btn btn-secondary">
                            Back
                        </a>

                        <button class="btn btn-success">
                            Start Import
                        </button>
                    </div>
                </form>

            </div>

            <div class="card-footer text-muted small">
                <strong>Note:</strong> Large files are processed in the background.
            </div>
        </div>

    </div>
</div>
@endsection
