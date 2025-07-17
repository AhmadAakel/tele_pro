@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1 text-gray-800">Verified Users Management</h1>
                    <p class="text-muted mb-0">Manage and monitor all verified users</p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-success fs-6">{{ $users->total() }} Verified Users</span>
                </div>
            </div>

            <!-- Search and Filters Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <form action="{{ route('verified.user.search') }}" method="GET" class="d-flex">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input 
                                        type="search" 
                                        name="query" 
                                        class="form-control border-start-0 ps-0" 
                                        placeholder="Search by name, email, phone, or channel..." 
                                        value="{{ request('query') }}"
                                        aria-label="Search verified users"
                                    >
                                    <button class="btn btn-success" type="submit">
                                        <i class="fas fa-search me-1"></i>Search
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            @if(request('query'))
                                <a href="{{ route('verifiedusers') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i>Clear Search
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Verified Users Table Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user-check me-2 text-success"></i>Verified Users List
                            </h5>
                        </div>
                        <div class="col-auto">
                            <small class="text-muted">
                                Showing {{ $users->firstItem() ?: 0 }} to {{ $users->lastItem() ?: 0 }} 
                                of {{ $users->total() }} results
                            </small>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    @if($users->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-semibold text-muted text-uppercase small">
                                            <i class="fas fa-user me-1"></i>User
                                        </th>
                                        <th class="border-0 fw-semibold text-muted text-uppercase small">
                                            <i class="fas fa-envelope me-1"></i>Contact
                                        </th>
                                        <th class="border-0 fw-semibold text-muted text-uppercase small">
                                            <i class="fas fa-paper-plane me-1"></i>Channel
                                        </th>
                                        <th class="border-0 fw-semibold text-muted text-uppercase small">
                                            <i class="fas fa-clock me-1"></i>Verified At
                                        </th>
                                        <th class="border-0 fw-semibold text-muted text-uppercase small">
                                            <i class="fas fa-shield-alt me-1"></i>Status
                                        </th>
                                        <th class="border-0 fw-semibold text-muted text-uppercase small text-center">
                                            <i class="fas fa-cog me-1"></i>Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr class="border-bottom">
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-3">
                                                        <div class="avatar-initial bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                            {{ strtoupper(substr($user->firstname, 0, 1) . substr($user->lastname, 0, 1)) }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1 fw-semibold">{{ $user->firstname }} {{ $user->lastname }}</h6>
                                                        <small class="text-muted">ID: #{{ $user->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td class="py-3">
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <i class="fas fa-envelope text-muted me-2" style="width: 12px;"></i>
                                                        <span class="small">{{ $user->email }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-phone text-muted me-2" style="width: 12px;"></i>
                                                        <span class="small text-muted">{{ $user->phone }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td class="py-3">
                                                @if($user->telegram_channel_url)
                                                    <div>
                                                        <a href="{{ $user->telegram_channel_url }}" target="_blank" class="text-decoration-none">
                                                            <span class="badge bg-info-subtle text-info fw-medium">
                                                                <i class="fab fa-telegram-plane me-1"></i>View Channel
                                                            </span>
                                                        </a>
                                                        <div class="small text-muted mt-1">
                                                            {{ Str::limit($user->telegram_channel_url, 30) }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted small">
                                                        <i class="fas fa-minus me-1"></i>No channel
                                                    </span>
                                                @endif
                                            </td>
                                            
                                            <td class="py-3">
                                                <div>
                                                    <span class="fw-medium text-success">
                                                        {{ \Carbon\Carbon::parse($user->email_verified_at)->format('M d, Y') }}
                                                    </span>
                                                    <div class="small text-muted">
                                                        {{ \Carbon\Carbon::parse($user->email_verified_at)->format('H:i') }}
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td class="py-3">
                                                <span class="badge bg-success d-inline-flex align-items-center">
                                                    <i class="fas fa-check-circle me-1"></i>Verified
                                                </span>
                                            </td>
                                            
                                            <td class="py-3 text-center">
                                                @if(auth()->check() && auth()->user()->is_admin)
                                                    <button 
                                                        type="submit" 
                                                        class="btn btn-outline-danger btn-sm"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal{{ $user->id }}"
                                                    >
                                                        <i class="fas fa-trash-alt me-1"></i>Remove
                                                    </button>
                                                    
                                                    <!-- Delete Confirmation Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header border-0 pb-0">
                                                                    <h5 class="modal-title">
                                                                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                                                                        Confirm User Removal
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="text-center">
                                                                        <div class="mb-3">
                                                                            <div class="avatar-initial bg-danger-subtle text-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 24px;">
                                                                                <i class="fas fa-user-times"></i>
                                                                            </div>
                                                                        </div>
                                                                        <h6 class="mb-2">Remove Verified User</h6>
                                                                        <p class="text-muted mb-0">
                                                                            Are you sure you want to remove <strong>{{ $user->firstname }} {{ $user->lastname }}</strong>?
                                                                            This action cannot be undone.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer border-0 pt-0">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                        <i class="fas fa-times me-1"></i>Cancel
                                                                    </button>
                                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">
                                                                            <i class="fas fa-trash-alt me-1"></i>Remove User
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-user-check text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="text-muted">No Verified Users Found</h5>
                            <p class="text-muted mb-0">
                                @if(request('query'))
                                    No verified users match your search criteria. Try adjusting your search terms.
                                @else
                                    There are currently no verified users in the system.
                                @endif
                            </p>
                            @if(request('query'))
                                <a href="{{ route('verifiedusers') }}" class="btn btn-success mt-3">
                                    <i class="fas fa-arrow-left me-1"></i>View All Verified Users
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
                
                <!-- Pagination -->
                @if($users->hasPages())
                    <div class="card-footer bg-light border-top">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="text-muted small">
                                    Showing {{ $users->firstItem() ?: 0 }} to {{ $users->lastItem() ?: 0 }} 
                                    of {{ $users->total() }} results
                                </div>
                            </div>
                            <div class="col-md-6">
                                <nav aria-label="Verified users pagination">
                                    {{ $users->appends(request()->query())->links('custom.pagination') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.avatar-initial {
    font-weight: 600;
    font-size: 14px;
}

.table th {
    font-size: 11px;
    letter-spacing: 0.5px;
}

.badge {
    font-weight: 500;
}

.btn-outline-danger:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(220, 53, 69, 0.2);
}

.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.table-hover tbody tr:hover {
    background-color: rgba(25, 135, 84, 0.02);
}

.input-group-text {
    background-color: #f8f9fa;
}

.modal-content {
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.bg-info-subtle {
    background-color: rgba(13, 202, 240, 0.1) !important;
}

.text-info {
    color: #0dcaf0 !important;
}

.bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1) !important;
}
</style>
@endsection