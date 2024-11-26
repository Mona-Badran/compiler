<?php

namespace App\Http\Auth;

use Closure;
use Illuminate\Http\Request;
use App\Models\Workspace;

class WorkspaceOwnerAuth
{
    public function handle(Request $request, Closure $next)
    {
            $workspace = Workspace::where('id', $request->workspaces_id)
                                    ->where('users_id', $request->user()->id)
                                    ->first();

        if (!$workspace) {
            return response()->json([
                "error" => "Unauthorized. You do not own this workspace."
            ], 403);
        }

        return $next($request);
    }
}
