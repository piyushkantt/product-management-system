@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">📊 Import Progress</h5>
            </div>

            <div class="card-body">

                {{-- Status --}}
                <p class="mb-2">
                    <strong>Status:</strong>
                    <span class="badge 
                        @if($importJob->status === 'completed') bg-success
                        @elseif($importJob->status === 'failed') bg-danger
                        @else bg-warning text-dark
                        @endif
                    ">
                        {{ ucfirst($importJob->status) }}
                    </span>
                </p>

                {{-- Record Count --}}
                <p class="text-muted mb-3">
                    {{ $importJob->processed_rows }}
                    /
                    {{ $importJob->total_rows }}
                    records processed
                </p>

                @php
                    $percent = $importJob->total_rows > 0
                        ? round(($importJob->processed_rows / $importJob->total_rows) * 100)
                        : 0;
                @endphp

                {{-- Progress Bar --}}
                <div class="progress mb-4" style="height: 24px;">
                    <div
                        class="progress-bar progress-bar-striped
                            @if($importJob->status !== 'completed') progress-bar-animated @endif
                        "
                        role="progressbar"
                        style="width: {{ $percent }}%;"
                        aria-valuenow="{{ $percent }}"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        {{ $percent }}%
                    </div>
                </div>

                {{-- User Friendly Messages --}}
                @if($importJob->status === 'completed')
                    <div class="alert alert-success">
                        ✅ <strong>Import completed!</strong><br>
                        All products have been successfully imported.
                    </div>
                @elseif($importJob->status === 'failed')
                    <div class="alert alert-danger">
                        ❌ <strong>Import failed.</strong><br>
                        Something went wrong. Please check logs or try again.
                    </div>
                @else
                    <div class="alert alert-info">
                        ☕ <strong>Please relax!</strong><br>
                        Your import is running in the background.<br>
                        You may refresh this page or visit other sections safely.<br><br>
                        📧 You’ll receive an email notification once the import is completed.
                    </div>
                @endif

            </div>

            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    ← Back to Products
                </a>

                <a href="{{ route('admin.products.import.form') }}" class="btn btn-outline-primary">
                    ⬆ New Import
                </a>
            </div>
        </div>

    </div>
</div>

{{-- Auto refresh while import is running --}}
@if($importJob->status === 'pending' || $importJob->status === 'processing')
<script>
    setTimeout(() => {
        window.location.reload();
    }, 5000); // refresh every 5 seconds
</script>
@endif
@endsection
