use App\Http\Controllers\BookController;

Route::apiResource('books', BookController::class);
Route::apiResource('mangos', MangoController::class);
