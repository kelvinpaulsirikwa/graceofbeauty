@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Leadership Team</h2>
        <a href="{{ route('admin.leadership_teams.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Member
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Rank</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leadershipTeams as $member)
                            <tr>
                                <td>{{ $member->leadership_team_id }}</td>
                                <td>
                                    @if($member->image)
                                        <img src="{{ Storage::url($member->image) }}" alt="{{ $member->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->rank }}</td>
                                <td>{{ $member->phonenumber ?? 'N/A' }}</td>
                                <td>{{ $member->gmail ?? 'N/A' }}</td>
                                <td>{{ $member->creator->name ?? 'N/A' }}</td>
                                <td>{{ $member->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.leadership_teams.show', $member->leadership_team_id) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('admin.leadership_teams.edit', $member->leadership_team_id) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.leadership_teams.destroy', $member->leadership_team_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this member?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No leadership team members found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($leadershipTeams->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $leadershipTeams->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

