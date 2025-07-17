@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1 text-gray-800">Channel Users Management</h1>
                    <p class="text-muted mb-0">Users registered for this Telegram channel</p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-info fs-6">{{ $users->total() }} Channel Users</span>
                </div>
            </div>
        
            <!-- Channel Info Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <div class="bg-info-subtle text-info rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fab fa-telegram-plane fs-4"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1">
                                        <i class="fab fa-telegram-plane me-2 text-info"></i>Telegram Channel
                                    </h5>
                                    <a href="{{ $channel->telegram_channel_url }}" target="_blank" class="text-decoration-none">
                                        <span class="badge bg-info-subtle text-info fw-medium fs-6">
                                            {{ $channel->telegram_channel_url }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <div class="d-flex flex-column align-items-md-end">
                                <small class="text-muted">Total Registered Users</small>
                                <h4 class="mb-0 text-info">{{ $users->total() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <form action="{{ route('verified.user.search', $channel->id) }}" method="GET" class="d-flex">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input 
                                        type="search" 
                                        name="query" 
                                        class="form-control border-start-0 ps-0" 
                                        placeholder="Search by name, email, or phone..." 
                                        value="{{ request('query') }}"
                                        aria-label="Search channel users"
                                    >
                                    <button class="btn btn-info" type="submit">
                                        <i class="fas fa-search me-1"></i>Search
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            @if(request('query'))
                                <a href="{{ route('channel.users', $channel->id) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i>Clear Search
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-users me-2 text-info"></i>Channel Users List
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
                                            <i class="fas fa-shield-alt me-1"></i>Verification
                                        </th>
                                        <th class="border-0 fw-semibold text-muted text-uppercase small">
                                            <i class="fas fa-clock me-1"></i>Status
                                        </th>
                                        <!-- <th class="border-0 fw-semibold text-muted text-uppercase small text-center">
                                            <i class="fas fa-cog me-1"></i>Actions
                                        </th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        @if(!$user->is_admin)
                                            <tr class="border-bottom">
                                                <td class="py-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-3">
                                                            <div class="avatar-initial bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
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
                                                    @if($user->is_verified)
                                                        <div>
                                                            <span class="badge bg-success-subtle text-success fw-medium">
                                                                <i class="fas fa-check-circle me-1"></i>Verified
                                                            </span>
                                                            @if($user->email_verified_at)
                                                                <div class="small text-muted mt-1">
                                                                    {{ \Carbon\Carbon::parse($user->email_verified_at)->format('M d, Y H:i') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div>
                                                            <span class="badge bg-warning-subtle text-warning fw-medium">
                                                                <i class="fas fa-clock me-1"></i>Code: {{ $user->verification_code }}
                                                            </span>
                                                            <div class="small text-muted mt-1">Pending verification</div>
                                                        </div>
                                                    @endif
                                                </td>
                                                
                                                <td class="py-3">
                                                    @if($user->is_verified)
                                                        <span class="badge bg-success d-inline-flex align-items-center">
                                                            <i class="fas fa-check-circle me-1"></i>Active
                                                        </span>
                                                    @else
                                                        <span class="badge bg-warning d-inline-flex align-items-center">
                                                            <i class="fas fa-hourglass-half me-1"></i>Pending
                                                        </span>
                                                    @endif
                                                </td>
                                                
                                                <!-- <td class="py-3 text-center">
                                                    @if(!$user->is_admin && auth()->check() && auth()->user()->is_admin)
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-outline-danger btn-sm"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#deleteModal{{ $user->id }}"
                                                        >
                                                            <i class="fas fa-trash-alt me-1"></i>Remove
                                                        </button> -->
                                                        
                                                        <!-- Delete Confirmation Modal -->
                                                         <!-- <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1">
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
                                                    </div> -->
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fab fa-telegram-plane text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="text-muted">No Users Found</h5>
                            <p class="text-muted mb-0">
                                @if(request('query'))
                                    No users match your search criteria for this channel.
                                @else
                                    There are currently no users registered for this channel.
                                @endif
                            </p>
                            @if(request('query'))
                                <a href="{{ route('channel.users', $channel->id) }}" class="btn btn-info mt-3">
                                    <i class="fas fa-arrow-left me-1"></i>View All Channel Users
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
                                <nav aria-label="Channel users pagination">
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
    background-color: rgba(13, 202, 240, 0.02);
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

.bg-warning-subtle {
    background-color: rgba(255, 193, 7, 0.1) !important;
}

.text-warning {
    color: #ffc107 !important;
}

.bg-danger-subtle {
    background-color: rgba(220, 53, 69, 0.1) !important;
}
</style>
@endsection