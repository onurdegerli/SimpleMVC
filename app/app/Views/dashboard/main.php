<?php

/**
 * OrderStructure $orderStructure
 * CustomerStructure $customerStructure
 * ChartStructure $chartStructure
 */

?>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">SimpleMVC</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file"></span>
                            Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="shopping-cart"></span>
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="users"></span>
                            Customers
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <h5>From <?= $orderStructure->fromDate ?> to <?= $orderStructure->toDate ?></h5>

            <ul class="list-group">
                <li class="list-group-item"><strong>Total Order:</strong> <?= $orderStructure->totalOrder; ?></li>
                <li class="list-group-item"><strong>Total Revenue:</strong> <?= $orderStructure->totalRevenue; ?></li>
                <li class="list-group-item"><strong>Total Customer:</strong> <?= $customerStructure->totalCustomer; ?>
                </li>
            </ul>

            <canvas class="my-4 w-100" id="statistics" width="900" height="380"></canvas>

            <h6>More statistics</h6>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="<?= getenv('DOMAIN') ?>">
                        Last month
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="<?= getenv('DOMAIN') ?>/?from=2020-05-05&to=2020-06-05">
                        From 2020-05-05 to 2020-06-05
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="<?= getenv('DOMAIN') ?>/?from=2020-01-02&to=2020-02-02">
                        From 2020-01-02 to 2020-02-02
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="<?= getenv('DOMAIN') ?>/?from=2019-07-06&to=2019-08-05">
                        From 2019-07-06 to 2019-08-05
                    </a>
                </li>
            </ul>
        </main>
    </div>
</div>
<script>
  window.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('statistics')
    // eslint-disable-next-line no-unused-vars
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?=json_encode($chartStructure->labels) ?>,
        datasets: <?=json_encode($chartStructure->dataset) ?>,
      },
      options: {
        title: {
          display: true,
          text: 'Monthly Statistics'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false
            }
          }]
        },
        legend: {
          display: false
        }
      }
    })
  });
</script>