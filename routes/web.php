

<!--use App\Http\Controllers\ProfileController;-->
<!--use Illuminate\Support\Facades\Route;-->

<!--/*-->
<!--|---------------------------------------------------------------------------->
<!--| Web Routes-->
<!--|---------------------------------------------------------------------------->
<!--|-->
<!--| Here is where you can register web routes for your application. These-->
<!--| routes are loaded by the RouteServiceProvider and all of them will-->
<!--| be assigned to the "web" middleware group. Make something great!-->
<!--|-->
<!--*/-->

<!--Route::get('/', function () {-->
<!--    return view('welcome');-->
<!--});-->

<!--Route::get('/dashboard', function () {-->
<!--    return view('dashboard');-->
<!--})->middleware(['auth', 'verified'])->name('dashboard');-->

<!--Route::middleware('auth')->group(function () {-->
<!--    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');-->
<!--    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');-->
<!--    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');-->
<!--});-->

<!--require __DIR__.'/auth.php';-->


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TasksController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [TasksController::class, 'index']);
Route::get('/dashboard', [TasksController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {
    Route::resource('tasks', TasksController::class);
});

?>