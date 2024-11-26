<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Workspace;

class WorkspaceOwnerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Ensure the workspace belongs to the authenticated user
        $workspace = Workspace::where('id', $request->workspaces_id)
                              ->where('users_id', $request->user()->id)
                              ->first();

        if (!$workspace) {
            return response()->json([
                "error" => "Unauthorized. You do not own this workspace."
            ], 403);
        }

        return $next($request); // Proceed to the next middleware or controller
    }
}
