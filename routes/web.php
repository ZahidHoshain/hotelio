<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\HotelioController;
use App\Http\Controllers\AccountLedgerController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTransferController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\TaxSettingController;
use App\Http\Controllers\BankLedgerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Ramsey\Uuid\Guid\Guid;

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

Route::get('/', [HotelioController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('user', RegisteredUserController::class);
/*Bank's Route's */
Route::get('bank/trash', [BankController::class, 'trash']);
Route::get('/bank/delete', [BankController::class, 'destroyAll']);
Route::get('bank/{id}/restore', [BankController::class, 'restore']);
Route::get('bank/restoreAll', [BankController::class, 'restoreAll']);
Route::get('/bank/{id}/parmanently/delete', [BankController::class, 'forceDeleted']);
Route::get('bank/emptyTrash', [BankController::class, 'emptyTrash']);
Route::get('/bank/delete/{id}',[BankController::class,'destroy']);
Route::resource('bank', BankController::class);

/*acount ledger Route */
Route::get('acount/ledger/emptytrash', [AccountLedgerController::class, 'emtyTrash']);
Route::get('acount/ledger/restoreall', [AccountLedgerController::class, 'restoreAll']);
Route::get('acount/ledger/restore/{id}', [AccountLedgerController::class, 'restore']);
Route::get('acount/ledger/delete/parmanently/{id}', [AccountLedgerController::class, 'forceDelete']);
Route::get('acount/ledger/trash', [AccountLedgerController::class, 'trash']);
Route::get('acount/ledger/delete', [AccountLedgerController::class, 'deleteAll']);
Route::get('acount/ledger/{id}', [AccountLedgerController::class, 'destroy']);
Route::resource('acount/ledger', AccountLedgerController::class);

/*balance Route */
Route::get('balance/emptytrash', [BalanceController::class, 'emtyTrash']);
Route::get('balance/restoreall', [BalanceController::class, 'restoreAll']);
Route::get('balance/{id}/restore', [BalanceController::class, 'restore']);
Route::get('balance/{id}/delete/parmanently', [BalanceController::class, 'forceDelete']);
Route::get('balance/trash', [BalanceController::class, 'trash']);
Route::get('balance/delete', [BalanceController::class, 'deleteAll']);
Route::resource('balance', BalanceController::class);

/*Bank ledger*/
Route::get('bankLedger/emptytrash', [BankLedgerController::class, 'emtyTrash']);
Route::get('bankLedger/restoreall', [BankLedgerController::class, 'restoreAll']);
Route::get('bankLedger/{id}/restore', [BankLedgerController::class, 'restore']);
Route::get('bankLedger/{id}/delete/parmanently', [BankLedgerController::class, 'forceDelete']);
Route::get('bankLedger/trash', [BankLedgerController::class, 'trash']);
Route::get('bankLedger/delete', [BankLedgerController::class, 'deleteAll']);
Route::get('bankLedger/delete/{id}', [BankLedgerController::class, 'destroy']);
Route::resource('/bankLedger', BankLedgerController::class);

/*room Route */
Route::get('/room/delete', [RoomController::class, 'destroyAll']);
Route::get('/room/trash', [RoomController::class, 'trash']);
Route::get('/room/{id}/restore', [RoomController::class, 'restore']);
Route::get('/room/restoreAll', [RoomController::class, 'restoreAll']);
Route::get('/room/{id}/parmanently/delete', [RoomController::class, 'forceDeleted']);
Route::get('/Room/emptyTrash', [RoomController::class, 'emptyTrash']);
Route::resource('room', RoomController::class);

/*room transfer Route */
Route::get('roomTransfer/trash', [RoomTransferController::class, 'trash']);
Route::get('/roomTransfer/delete', [RoomTransferController::class, 'destroyAll']);
Route::get('roomTransfer/{id}/restore', [RoomTransferController::class, 'restore']);
Route::get('roomTransfer/restoreAll', [RoomTransferController::class, 'restoreAll']);
Route::get('/roomTransfer/{id}/parmanently/delete', [RoomTransferController::class, 'forceDeleted']);
Route::get('/roomTransfer/emptyTrash', [RoomTransferController::class, 'emptyTrash']);
Route::resource('roomTransfer', RoomTransferController::class);

/*booking Route */
Route::get('/booking/trash', [BookingController::class, 'trash']);
Route::get('/booking/delete', [BookingController::class, 'destroyAll']);
Route::get('/Booking/{id}/restore', [BookingController::class, 'restore']);
Route::get('/booking/restoreAll', [BookingController::class, 'restoreAll']);
Route::get('/Booking/{id}/parmanently/delete', [BookingController::class, 'forceDeleted']);
Route::get('/booking/emptyTrash', [BookingController::class, 'emptyTrash']);
Route::resource('booking', BookingController::class);

/** Invoice Routes */
Route::get('/invoice/trash', [InvoiceController::class, 'trash']);
Route::get('/invoice/delete', [InvoiceController::class, 'destroyAll']);
Route::get('/invoice/{id}/restore', [InvoiceController::class, 'restore']);
Route::get('/invoice/restoreAll', [InvoiceController::class, 'restoreAll']);
Route::get('/invoice/{id}/parmanently/delete', [InvoiceController::class, 'forceDeleted']);
Route::get('/invoice/emptyTrash', [InvoiceController::class, 'emptyTrash']);
Route::resource('invoice', InvoiceController::class);

/** Guest Routes */
Route::get('/guest/trash', [GuestController::class, 'trash']);
Route::get('/guest/delete', [GuestController::class, 'destroyAll']);
Route::get('/guest/{id}/restore', [GuestController::class, 'restore']);
Route::get('/guest/restoreAll', [GuestController::class, 'restoreAll']);
Route::get('/guest/{id}/parmanently/delete', [GuestController::class, 'forceDelete']);
Route::get('/guest/emptyTrash', [GuestController::class, 'emptyTrash']);
Route::get('/guest/delete/{id}',[GuestController::class,'destroy']);
Route::resource('guest', GuestController::class);

/*Employee Route's */
Route::get('/employee/trash', [EmployeeController::class, 'trash']);
Route::get('/employee/delete', [EmployeeController::class, 'destroyAll']);
Route::get('/employee/{id}/restore', [EmployeeController::class, 'restore']);
Route::get('/employee/restoreAll', [EmployeeController::class, 'restoreAll']);
Route::get('/employee/{id}/parmanently/delete', [EmployeeController::class, 'forceDeleted']);
Route::get('/employee/emptyTrash', [EmployeeController::class, 'emptyTrash']);
Route::get('/employee/delete/{id}',[EmployeeController::class,'destroy']);
Route::resource('employee', EmployeeController::class);

/*Hotel Routes*/
Route::get('/hotel/trash', [HotelController::class, 'trash']);
Route::get('/hotel/delete', [HotelController::class, 'destroyAll']);
Route::get('hotel/{id}/restore', [HotelController::class, 'restore']);
Route::get('/hotel/restoreAll', [HotelController::class, 'restoreAll']);
Route::get('/hotel/{id}/parmanently/delete', [HotelController::class, 'forceDeleted']);
Route::get('/hotel/emptyTrash', [HotelController::class, 'emptyTrash']);
Route::get('/hotel/delete/{id}',[HotelController::class,'destroy']);
Route::resource('hotel', HotelController::class);

/*Income Category Routes*/
Route::get('/income/category/trash', [IncomeCategoryController::class, 'trash']);
Route::get('/income/category/delete', [IncomeCategoryController::class, 'destroyAll']);
Route::get('/income/category/{id}/parmanently/delete',[IncomeCategoryController::class, 'forceDelete']);
Route::get('/income/category/{id}/restore', [IncomeCategoryController::class, 'restore']);
Route::get('/income/category/restoreAll', [IncomeCategoryController::class, 'restoreAll']);
Route::get('/income/category/emptyTrash', [IncomeCategoryController::class, 'emptyTrash']);
Route::resource('/income/category', IncomeCategoryController::class);

/*Income Routes*/
Route::get('/income/trash', [IncomeController::class, 'trash']);
Route::get('/income/delete', [IncomeController::class, 'destroyAll']);
Route::get('/income/{id}/parmanently/delete', [IncomeController::class, 'forceDelete']);
Route::get('/income/{id}/restore', [IncomeController::class, 'restore']);
Route::get('/income/restoreAll', [IncomeController::class, 'restoreAll']);
Route::get('/income/emptyTrash', [IncomeController::class, 'emptyTrash']);
Route::get('/income/delete/{id}',[IncomeController::class,'destroy']);
Route::resource('income', IncomeController::class);

/*Expense Category Routes*/
Route::get('/expense/category/trash', [ExpenseCategoryController::class, 'trash']);
Route::get('/expense/category/delete', [ExpenseCategoryController::class, 'destroyAll']);
Route::get('/expense/category/{id}/parmanently/delete', [ExpenseCategoryController::class, 'forceDelete']);
Route::get('/expense/category/{id}/restore', [ExpenseCategoryController::class, 'restore']);
Route::get('/expense/category/restoreAll', [ExpenseCategoryController::class, 'restoreAll']);
Route::get('/expense/category/emptyTrash', [ExpenseCategoryController::class, 'emptyTrash']);
Route::resource('expense/category', ExpenseCategoryController::class);

/*Expense Routes*/
Route::get('/expense/trash', [ExpenseController::class, 'trash']);
Route::get('/expense/delete', [ExpenseController::class, 'destroyAll']);
Route::get('/expense/{id}/parmanently/delete', [ExpenseController::class, 'forceDelete']);
Route::get('/expense/{id}/restore', [ExpenseController::class, 'restore']);
Route::get('/expense/restoreAll', [ExpenseController::class, 'restoreAll']);
Route::get('/expense/emptyTrash', [ExpenseController::class, 'emptyTrash']);
Route::get('/expense/delete/{id}',[ExpenseController::class,'destroy']);
Route::resource('expense', ExpenseController::class);

/** User route*/
Route::resource('user', UserController::class);

/*tax Setting route */
Route::get('/taxSetting/trash', [TaxSettingController::class, 'trash']);
Route::get('/taxSetting/delete', [TaxSettingController::class, 'destroyAll']);
Route::get('/taxSetting/{id}/restore', [TaxSettingController::class, 'restore']);
Route::get('/taxSetting/restoreAll', [TaxSettingController::class, 'restoreAll']);
Route::get('/taxSetting/{id}/parmanently/delete', [TaxSettingController::class, 'forceDeleted']);
Route::get('/taxSetting/emptyTrash', [TaxSettingController::class, 'emptyTrash']);
Route::get('taxSetting/delete/{id}', [TaxSettingController::class, 'destroy']);
Route::resource('taxSetting', TaxSettingController::class);

/*Profile route */
Route::get('profile/show', [ProfileController::class, 'index']);
