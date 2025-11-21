<?php
$page = "Orders";
?>
<!doctype html>
<html lang="en">

<?php 
include 'component/head.php';
?>

<body>

<?php 
include 'component/nav.php';
?>

<div class="container-fluid">
  <div class="row">

    <!-- SIDEBAR -->
    <?php include 'component/sidebar.php'; ?>

    <?php
    // Load orders function
    include 'functions/orders.php';

    $search = isset($_GET['search']) ? $_GET['search'] : "";
    $orders = getAllOrders($search);
    ?>

    <!-- MAIN CONTENT -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Orders</h1>
      </div>

      <!-- SEARCH BAR -->
      <form method="GET" class="form-inline mb-3">
        <input type="text" 
               name="search" 
               class="form-control mr-2" 
               placeholder="Search orders..."
               value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="btn btn-primary">Search</button>
      </form>

      <!-- ORDERS TABLE -->
      <div class="table-responsive mt-3">
        <table class="table table-striped table-sm text-center">
          <thead class="thead-light">
            <tr>
              <th>ID</th>
              <th>Customer</th>
              <th>Date</th>
              <th>SubTotal</th>
              <th>Tax</th>
              <th>Total</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($orders as $row): ?>
              <tr>
                <td><?= $row['inv_number'] ?></td>
                <td><?= $row['customer_name'] ?></td>
                <td><?= strtoupper(date("d M Y", strtotime($row['inv_date']))) ?></td>
                <td><?= number_format($row['inv_subtotal'], 2) ?></td>
                <td><?= number_format($row['inv_tax'], 2) ?></td>
                <td><?= number_format($row['inv_total'], 2) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>

        </table>
      </div>

    </main>

  </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>