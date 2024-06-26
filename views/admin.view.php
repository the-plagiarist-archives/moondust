<?php require 'partials/head.php'; ?>
<?php require 'partials/navbar.php'; ?>

<main class="my-32">
  <div class="container mx-auto">
    <h1 class="text-6xl font-bold text-[#AEA089] mb-10">Dashboard</h1>
    <div class="bg-[#FAF6F2] py-12">
      <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
          <div class="bg-[#AEA089] px-4 py-6 sm:px-6 lg:px-8 rounded-lg">
            <p class="text-sm font-medium leading-6 text-white">Number of Users</p>
            <p class="mt-2 flex items-baseline gap-x-2">
              <span class="text-4xl font-semibold tracking-tight text-white"><?php echo $userCount; ?></span>
            </p>
          </div>
          <div class="bg-[#AEA089] px-4 py-6 sm:px-6 lg:px-8 rounded-lg">
            <p class="text-sm font-medium leading-6 text-white">Number of Products</p>
            <p class="mt-2 flex items-baseline gap-x-2">
              <span class="text-4xl font-semibold tracking-tight text-white"><?php echo $product_count; ?></span>
            </p>
          </div>
          <div class="bg-[#AEA089] px-4 py-6 sm:px-6 lg:px-8 rounded-lg">
            <p class="text-sm font-medium leading-6 text-white">Total Sales</p>
            <p class="mt-2 flex items-baseline gap-x-2">
              <span class="text-4xl font-semibold tracking-tight text-white">₱<?php echo number_format($total_sales, 2); ?></span>
            </p>
          </div>
          <div class="bg-[#AEA089] px-4 py-6 sm:px-6 lg:px-8 rounded-lg">
            <p class="text-sm font-medium leading-6 text-white">Total Orders</p>
            <p class="mt-2 flex items-baseline gap-x-2">
              <span class="text-4xl font-semibold tracking-tight text-white"><?php echo $total_orders; ?></span>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- Products Table -- added stock --> 
    <div class="pt-20 border-t border-gray-200">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-3xl font-semibold leading-6 text-[#AEA089]">Products</h1>
          <p class="mt-4 text-sm text-gray-700">A list of all the products in your store including their name, price, and image.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
          <a href="/new" class="block rounded-md bg-[#AEA089] px-3 py-2 text-center text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#AEA089]">Add Product</a>
        </div>
      </div>
      <div class="mt-8 flow-root justify-center">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full divide-y divide-gray-300">
              <thead>
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-0">Product Image</th>
                  <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Product Name</th>
                  <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Unit Price</th>
                  <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Stock</th>
                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0 text-center">
                    <span class="sr-only">Actions</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 text-center">
                <?php foreach ($products as $product) { ?>
                  <tr>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0">
                      <img class="w-20 h-20 rounded-xl object-cover mx-auto" src="/<?php echo htmlspecialchars($product["main_image"]); ?>" alt="Product Image">
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900"><?php echo htmlspecialchars($product["product_name"]); ?></td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">₱<?php echo htmlspecialchars($product["unit_price"]); ?></td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo htmlspecialchars($product["stock_available"]); ?></td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                      <a href="/products/<?php echo htmlspecialchars($product["product_id"]); ?>/edit" class="font-bold text-[#AEA089]">Edit<span class="sr-only">, <?php echo htmlspecialchars($product["product_name"]); ?></span></a>
                      <form class="inline" action="/products/<?php echo htmlspecialchars($product["product_id"]); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product["product_id"]); ?>">
                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4 font-bold">Delete</button>
                      </form>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Invoices Table -->
    <div class="pt-20 border-t border-gray-200">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-3xl font-semibold leading-6 text-[#AEA089]">Invoices</h1>
          <p class="mt-4 text-sm text-gray-700">A list of recent invoices including status, order date, total price, and order items.</p>
        </div>
      </div>
      <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full divide-y divide-gray-300">
              <thead>
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-0">Customer Username</th>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-0">Order Date</th>
                  <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Total Price</th>
                  <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Order Items</th>
                  <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Status</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 text-center">
                <?php foreach ($orders as $order) { ?>
                  <tr>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0"><?php echo htmlspecialchars($order["username"]); ?></td>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0"><?php echo htmlspecialchars($order["order_date"]); ?></td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">₱<?php echo htmlspecialchars($order["order_total"]); ?></td>
                    <td class="px-3 py-4 text-sm text-gray-500">
                      <ul class="list-disc list-inside">
                        <?php foreach ($order["order_items"] as $item) { ?>
                          <li><?php echo htmlspecialchars($item['product_name']); ?> - <?php echo htmlspecialchars($item['order_quantity']); ?> units</li>
                        <?php } ?>
                      </ul>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                      <form action="/admin" method="post">
                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                        <select class="bg-[#AEA089] text-white px-2 py-2 rounded-xl" name='status_id' >
                          <?php foreach ($statuses as $status) { ?>
                            <option value="<?php echo htmlspecialchars($status['status_id']); ?>" <?php if ($status['status_id'] == $order['status_id']) { echo 'selected'; } ?> >
                              <?php echo htmlspecialchars($status['name']); ?>
                            </option>
                          <?php } ?>
                        </select>
                        <button class="ml-2 text-[#AEA089] font-bold" type='submit'>Update Status</button>
                      </form>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Users Table -->
    <div class="pt-20 border-t border-gray-200">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-3xl font-semibold leading-6 text-[#AEA089]">User Management</h1>
          <p class="mt-4 text-sm text-gray-700">A list of users, categorized based on their roles. The admin can also set a user to an admin.</p>
        </div>
      </div>
      <div class="mt-8 flow-root">
        <div class="w-full -mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="w-full grid gap-4">
              <table class="divide-y divide-gray-300">
                <thead>
                  <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-0">Customer Username</th>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-0">Role</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-center">
                  <?php foreach ($users as $user) { ?>
                    <tr>
                      <td class="w-full whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0"><?php echo htmlspecialchars($user["username"]); ?></td>
                      <td class="w-full whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0"><?php echo htmlspecialchars($user["role_name"]); ?></td>
                      <?php if ($user['role_id'] != 2) { ?>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0">
                          <form action="/admin" method='post'>
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user["user_id"]); ?>">
                            <button class="bg-[#AEA089] text-white px-4 py-2 rounded-xl" type="submit">Make Admin</button>
                          </form>
                        </td>
                      <?php } ?>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
