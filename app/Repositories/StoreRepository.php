<?

namespace App\Repositories;

use App\Models\Store;
use App\Repositories\Interfaces\StoreRepositoryInterface;

class StoreRepository implements StoreRepositoryInterface
{
    public function all()
    {
        $stores = Store::Paginate(10);;
        return $stores;
    }

    public function create(array $data)
    {
        // return Store::create($data);
    }
}
