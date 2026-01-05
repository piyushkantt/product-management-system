@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Customers</h4>
</div>

@if($customers->count())
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Joined</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                           <td>
    <span
        id="status-{{ $customer->id }}"
        class="badge {{ $customer->is_online ? 'bg-success' : 'bg-secondary' }}"
    >
        {{ $customer->is_online ? 'Online' : 'Offline' }}
    </span>
</td>

                            <td>{{ $customer->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $customers->links() }}
    </div>
@else
    <div class="alert alert-info">
        No customers found.
    </div>
@endif
@push('scripts')
<script>
(function waitForEcho() {
    if (typeof window.Echo === 'undefined') {
        console.log('Waiting for Echo...');
        setTimeout(waitForEcho, 200);
        return;
    }

    console.log('Echo ready, joining customers.online');

  window.Echo.join('customers.online')
    .listen('.customer.status.updated', (e) => {
        console.log('EVENT RECEIVED', e);

        const badge = document.getElementById('status-' + e.data.id);
        if (!badge) return;

        badge.classList.remove('bg-success', 'bg-secondary');

        if (e.data.is_online) {
            badge.classList.add('bg-success');
            badge.innerText = 'Online';
        } else {
            badge.classList.add('bg-secondary');
            badge.innerText = 'Offline';
        }
    });

       

})();
</script>
@endpush




@endsection
