<?

namespace App\Repositories\Interfaces;

interface StoreRepositoryInterface
{
    public function all();
    public function create(array $data);
}
