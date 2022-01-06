<?php

namespace App\Http\Controllers\apis;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OrdersResource;

class UsersAPI extends Controller {

    function myacount(Request $request) {
        $user = $request->user();
        $arr = ['status' => 200, 'message' => '', 'data' => $user->toArray(), 'userdata' => $user->toArray()];
        return response()->json($arr);
    }

    function updateProfile(Request $request) {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',];
        if ($request->user()->email != $request->email)
            $rules['email'] = 'required|email|unique:users,email';
        if ($request->user()->phone != $request->phone)
            $rules['phone'] = 'required|unique:users,phone';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => $validator->errors()->all()]);
        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->hasFile('image'))
            $user->image = $this->uploadfile($request->image);
        if ($request->base_image != '')
            $user->image = $this->uploadbasfile($request->base_image);
        $user->save();
        $arr = ['status' => 200, 'message' => 'success', 'data' => $user->toArray()];
        return response()->json($arr);
    }

    function updatePassword(Request $request) {

        $rules = [
            'old_password' => 'required',
            'password' => 'required|string'
        ];
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            $arr = ['status' => 500, 'message' => $validator->errors()->all()[0], 'errors' => $validator->errors()->all()];

            return response()->json($arr);
        }
        if (!Hash::check($request->old_password, $request->user()->password)) {
            $arr = ['status' => 500, 'message' => 'password not correct', 'errors' => ['password not correct']];
            return response()->json(
                            $arr);
        }
        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();
        $arr = ['status' => 200, 'message' => 'password changed successfully', 'data' => ''];
        return response()->json($arr);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        $arr = ['status' => 200, 'message' => 'Successfully logged out'];
        return response()->json(
                        $arr);
    }

    function getAdreesses(Request $request) {
        return response()->json([
                    'status' => 200,
                    'message' => trans('messages.success'),
                    'data' => Address::where('user_id', auth()->guard('api')->user()->id)->get()
        ]);
    }

    function addAdreess(Request $request) {
        $v = Validator::make($request->all(), [
                    'city_id' => 'required|exists:cities,id',
                    'name' => 'required',
                    'district' => 'required',
                    'address' => 'required'
        ]);

        if ($v->fails())
            return response()->json(['status' => 500, 'message' => trans('messages.invalide_data'), 'errors' => $v->errors()->all()]);

        $address = new Address;
        $address->city_id = $request->city_id;
        $address->name = $request->name;
        $address->district = $request->district;
        $address->address = $request->address;
        $address->notes = $request->notes;
        $address->user_id = auth()->guard('api')->user()->id;
        $address->save();

        return response()->json([
                    'status' => 200,
                    'message' => trans('messages.success'),
                    'data' => Address::where('user_id', auth()->guard('api')->user()->id)->get()
        ]);
    }

    function updateDeviceId(Request $request) {
        $v = Validator::make($request->all(), [
                    'device_id' => 'required',
        ]);

        if ($v->fails())
            return response()->json(['status' => 500, 'message' => trans('messages.invalide_data'), 'errors' => $v->errors()->all()]);
        $user = auth()->guard('api')->user();
        $user->device_id = $request->device_id;
        $user->save();
        return response()->json(['status' => 200, 'message' => 'success']);
    }

    function updateAdrress(Request $request) {
        $v = Validator::make($request->all(), [
                    'address_id' => 'required|exists:addresses,id'
        ]);

        if ($v->fails())
            return response()->json(['status' => false, 'message' => trans('messages.invalide_data'), 'errors' => $v->errors()->all()]);

        $address = Address::where('id', $request->address_id)->where('user_id', $request->user()->id)->first();
        if (!is_object($address))
            return response()->json(['status' => 500, 'message' => trans('messages.invalide_data'), 'errors' => ['not found']]);

        $address->city_id = $request->city_id;
        $address->name = $request->name;
        $address->district = $request->district;
        $address->address = $request->address;
        $address->notes = $request->notes;
        $address->save();

        return response()->json([
                    'status' => 200,
                    'message' => trans('messages.success'),
                    'data' => Address::where('user_id', auth()->guard('api')->user()->id)->get()
        ]);
    }

    function orders(Request $request) {
        $orders = \App\Models\Order::where('user_id', $request->user()->id)->orderBy('id','desc')->get();
        return response()->json([
                    'status' => 200,
                    'message' => trans('messages.success'),
                    'data' => OrdersResource::collection($orders)
        ]);
    }

    function showOrder(Request $request) {
        $order = \App\Models\Order::where('id', $request->order_id)->first();
        return response()->json([
                    'status' => 200,
                    'message' => trans('messages.success'),
                    'data' => new OrdersResource($order)
        ]);
    }

    function deleteAdrress(Request $request) {
        $v = Validator::make($request->all(), [
                    'address_id' => 'required|exists:addresses,id'
        ]);

        if ($v->fails())
            return response()->json(['status' => 500, 'message' => trans('messages.invalide_data'), 'errors' => $v->errors()->all()]);

        $address = Address::where('id', $request->address_id)->where('user_id', $request->user()->id)->first();
        if (!is_object($address))
            return response()->json(['status' => 500, 'message' => trans('messages.invalide_data'), 'errors' => ['not found']]);

        $address->delete();

        return response()->json([
                    'status' => 200,
                    'message' => trans('messages.success'),
                    'data' => Address::where('user_id', auth()->guard('api')->user()->id)->get()
        ]);
    }

    private function uploadfile($file) {
        $path = 'uploads/users';
        if (!file_exists($path)) {
            mkdir($path, 0775);
        }
        $datepath = date('m-Y', strtotime(\Carbon\Carbon::now()));
        if (!file_exists($path . '/' . $datepath)) {
            mkdir($path . '/' . $datepath, 0775);
        }
        $newdir = $path . '/' . $datepath;
        $exten = $file->getClientOriginalExtension();
        $filename = $this->generateRandom($length = 15);
        $filename = $filename . '.' . $exten;
        $file->move($newdir, $filename);
        return $path . '/' . $filename;
    }

    private function generateRandom($length = 11) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = time();
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    private function uploadbasfile($file) {
        $path = 'uploads/users';
        if (!file_exists($path)) {
            mkdir($path, 0775);
        }
        $datepath = date('m-Y', strtotime(\Carbon\Carbon::now()));
        if (!file_exists($path . '/' . $datepath)) {
            mkdir($path . '/' . $datepath, 0775);
        }
        $newdir = $path . '/' . $datepath;
        $exten = 'png';
        $filename = $this->generateRandom($length = 15);
        $filename = $filename . '.' . $exten;
        $filedate = base64_decode($file);

        file_put_contents($newdir . '/' . $filename, $filedate);

        return $newdir . '/' . $filename;
    }

}
