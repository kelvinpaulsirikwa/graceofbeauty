@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Leadership Team Member Details</h2>
        <a href="{{ route('admin.leadership_teams.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Member ID:</dt>
                <dd class="col-sm-9">{{ $leadershipTeam->leadership_team_id }}</dd>

                <dt class="col-sm-3">Image:</dt>
                <dd class="col-sm-9">
                    @if($leadershipTeam->image)
                        <img src="{{ Storage::url($leadershipTeam->image) }}" alt="{{ $leadershipTeam->name }}" style="max-width: 300px; max-height: 300px; border-radius: 8px; border: 1px solid #ddd;">
                    @else
                        <span class="text-muted">No image uploaded</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Name:</dt>
                <dd class="col-sm-9">{{ $leadershipTeam->name }}</dd>

                <dt class="col-sm-3">Rank/Position:</dt>
                <dd class="col-sm-9">{{ $leadershipTeam->rank }}</dd>

                <dt class="col-sm-3">Phone Number:</dt>
                <dd class="col-sm-9">{{ $leadershipTeam->phonenumber ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Gmail:</dt>
                <dd class="col-sm-9">
                    @if($leadershipTeam->gmail)
                        <a href="mailto:{{ $leadershipTeam->gmail }}">{{ $leadershipTeam->gmail }}</a>
                    @else
                        N/A
                    @endif
                </dd>

                <dt class="col-sm-3">Facebook:</dt>
                <dd class="col-sm-9">
                    @if($leadershipTeam->facebook)
                        <a href="{{ $leadershipTeam->facebook }}" target="_blank" rel="noopener noreferrer">{{ $leadershipTeam->facebook }}</a>
                    @else
                        N/A
                    @endif
                </dd>

                <dt class="col-sm-3">Instagram:</dt>
                <dd class="col-sm-9">
                    @if($leadershipTeam->instagram)
                        <a href="{{ $leadershipTeam->instagram }}" target="_blank" rel="noopener noreferrer">{{ $leadershipTeam->instagram }}</a>
                    @else
                        N/A
                    @endif
                </dd>

                <dt class="col-sm-3">Description:</dt>
                <dd class="col-sm-9">{{ $leadershipTeam->description }}</dd>

                <dt class="col-sm-3">Created By:</dt>
                <dd class="col-sm-9">{{ $leadershipTeam->creator->name ?? 'N/A' }} ({{ $leadershipTeam->creator->email ?? 'N/A' }})</dd>

                <dt class="col-sm-3">Created At:</dt>
                <dd class="col-sm-9">{{ $leadershipTeam->created_at->format('Y-m-d H:i:s') }}</dd>

                <dt class="col-sm-3">Updated At:</dt>
                <dd class="col-sm-9">{{ $leadershipTeam->updated_at->format('Y-m-d H:i:s') }}</dd>
            </dl>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.leadership_teams.edit', $leadershipTeam->leadership_team_id) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit Member
                </a>
                <form action="{{ route('admin.leadership_teams.destroy', $leadershipTeam->leadership_team_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this member?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash"></i> Delete Member
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

