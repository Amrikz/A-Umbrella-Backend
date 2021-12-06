<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function get($id) : User
    {
        return User::findOrFail($id);
    }
//
//    public function edit(EditUserRequest $request, $id) : User
//    {
//        $data = $request->validated();
//        try
//        {
//            $result = DB::transaction(function() use ($data, $id)
//            {
//                $user = $this->get($id);
//                $user->update($data);
//
//                ActionLogService::add('edit','user', $user->id, Auth::id());
//
//                return $user;
//            });
//        }
//        catch (\Exception $e)
//        {
//            report($e);
//            throw new HttpResponseException(response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR));
//        }
//        return $result;
//    }
//
//    public function changePassword(ChangeUserPasswordRequest $request) : User
//    {
//        $data = $request->validated();
//        $user = Auth::user();
//
//        if ($user && password_verify($data['old_password'], $user->password))
//        {
//            if ($data['old_password'] == $data['new_password'])
//                throw new HttpResponseException(response()->json(['error' => 'Старый и новый пароли идентичны'], Response::HTTP_BAD_REQUEST));
//
//            if ($data['new_password'] != $data['confirm_password'])
//                throw new HttpResponseException(response()->json(['error' => 'Пароли не совпадают'], Response::HTTP_BAD_REQUEST));
//
//            $user->password = bcrypt($data['new_password']);
//            $user->save();
//            return $user;
//        }
//        else
//            throw new HttpResponseException(response()->json(['error' => 'Введён неправильный старый пароль'], Response::HTTP_BAD_REQUEST));
//
//    }
//
//    public function toggleRole($id) : User
//    {
//        if (Auth::id() == $id)
//            throw new HttpResponseException(response()
//                ->json(['error' => "Невозможно изменить роль самому себе"], Response::HTTP_BAD_REQUEST));
//
//        $user = $this->get($id);
//
//        if (!Auth::user()->organization->is($user->organization))
//            throw new HttpResponseException(response()
//                ->json(['error' => "Невозможно изменить роль пользователю не вашей организации"], Response::HTTP_UNAUTHORIZED));
//
//        if (!empty($user->ownOrganization))
//            throw new HttpResponseException(response()
//                ->json(['error' => "Невозможно изменить роль текущего владельца организации"], Response::HTTP_UNAUTHORIZED));
//
//        try
//        {
//            DB::transaction(function() use ($user)
//            {
//                if ($user->role->slug == 'admin')
//                    $role = Role::firstWhere('slug', 'user');
//                if ($user->role->slug == 'user')
//                    $role = Role::firstWhere('slug', 'admin');
//
//                $user->roles()->sync([$role->id]);
//                $user->load('role');
//
//                ActionLogService::add('edit','user', $user->id, Auth::id());
//            });
//        }
//        catch (\Exception $e)
//        {
//            report($e);
//            throw new HttpResponseException(response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR));
//        }
//        return $user;
//    }
//
//    public function destroy($id) : User
//    {
//        if (Auth::id() == $id)
//            throw new HttpResponseException(response()
//                ->json(['error' => "Невозможно удалить себя"], Response::HTTP_BAD_REQUEST));
//
//        $user = $this->get($id);
//
//        if (!Auth::user()->organization->is($user->organization))
//            throw new HttpResponseException(response()
//                ->json(['error' => "Невозможно удалить пользователя не вашей организации"], Response::HTTP_UNAUTHORIZED));
//
//        if (!empty($user->ownOrganization))
//            throw new HttpResponseException(response()
//                ->json(['error' => "Невозможно удалить текущего владельца организации"], Response::HTTP_UNAUTHORIZED));
//
////        if ($user->role->name != 'user')
////        {
////            $admins = User::byOrganization()->byRole('admin')->get();
////            $roots = User::byOrganization()->byRole('root')->get();
////            if ($admins->count() + $roots->count() < 2)
////                throw new HttpResponseException(response()
////                    ->json(['error' => "Невозможно удалить последнего администратора организации"], Response::HTTP_BAD_REQUEST));
////        }
//
//        try
//        {
//            DB::transaction(function() use ($user)
//            {
//                $user->delete();
//
//                $actionLogService = new ActionLogService();
//                $actionLogService->add('delete','user', $user->id, Auth::id());
//            });
//        }
//        catch (\Exception $e)
//        {
//            report($e);
//            throw new HttpResponseException(response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR));
//        }
//        return $user;
//    }
}
