@extends('templates.backend.layouts.main')

@section('content')

<style>
    .dashboard-header {
        background: linear-gradient(135deg, #0d6efd, #20c997);
        border-radius: 20px;
        padding: 28px;
        color: #fff;
        margin-bottom: 22px;
        box-shadow: 0 12px 30px rgba(0,0,0,.12);
    }

    .summary-card {
        border: none;
        border-radius: 20px;
        padding: 22px;
        color: #fff;
        box-shadow: 0 10px 25px rgba(0,0,0,.10);
        min-height: 140px;
    }

    .summary-icon {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        background: rgba(255,255,255,.18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .summary-title {
        font-size: 13px;
        opacity: .9;
        margin-top: 15px;
        margin-bottom: 4px;
    }

    .summary-value {
        font-size: 26px;
        font-weight: 800;
    }

    .bg-blue-gradient {
        background: linear-gradient(135deg, #0d6efd, #2563eb);
    }

    .bg-green-gradient {
        background: linear-gradient(135deg, #20c997, #059669);
    }

    .bg-orange-gradient {
        background: linear-gradient(135deg, #f59e0b, #f97316);
    }

    .bg-purple-gradient {
        background: linear-gradient(135deg, #8b5cf6, #6d28d9);
    }

    .dashboard-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0,0,0,.08);
        overflow: hidden;
    }

    .dashboard-card .card-header {
        background: #fff;
        border-bottom: 1px solid #eef0f3;
        padding: 18px 22px;
    }

    .quick-action-btn {
        border-radius: 16px;
        padding: 16px;
        font-weight: 700;
        display: block;
        text-align: center;
        transition: .2s ease;
        margin-bottom: 12px;
    }

    .quick-action-btn:hover {
        transform: translateY(-2px);
        text-decoration: none;
    }

    .progress {
        height: 18px;
        border-radius: 20px;
        background: #eef2f7;
    }

    .progress-bar {
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .mini-stat {
        background: #f8fafc;
        border-radius: 16px;
        padding: 15px;
        border: 1px solid #eef0f3;
    }

    .mini-stat-title {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 5px;
    }

    .mini-stat-value {
        font-size: 18px;
        font-weight: 800;
        color: #111827;
    }
</style>

<section class="content">
    <div class="container-fluid">

        <div class="dashboard-header">
            <h2 class="font-weight-bold mb-1">DMS Dashboard</h2>
            <p class="mb-0">Procurement document monitoring, analytics, and summary overview.</p>
        </div>

        <div class="row">

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="summary-card bg-blue-gradient">
                    <div class="summary-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <div class="summary-title">Total SIP Documents</div>
                    <div class="summary-value">{{ number_format($totalSip) }}</div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="summary-card bg-green-gradient">
                    <div class="summary-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="summary-title">Total Procurements</div>
                    <div class="summary-value">{{ number_format($totalProcurements) }}</div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="summary-card bg-orange-gradient">
                    <div class="summary-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="summary-title">Total Procurement Items</div>
                    <div class="summary-value">{{ number_format($totalItems) }}</div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="summary-card bg-purple-gradient">
                    <div class="summary-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="summary-title">Total Estimated Amount</div>
                    <div class="summary-value">₱{{ number_format($totalAmount, 2) }}</div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-8 mb-3">
                <div class="card dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fas fa-chart-bar text-primary"></i> Quarterly Procurement Allocation
                        </h5>
                    </div>

                    <div class="card-body">
                        <canvas id="quarterChart" height="110"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class="card dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fas fa-bolt text-warning"></i> Quick Actions
                        </h5>
                    </div>

                    <div class="card-body">
                        <a href="{{ route('sip.main') }}" class="quick-action-btn bg-primary text-white">
                            <i class="fas fa-folder-open"></i> Manage SIP
                        </a>

                        <a href="{{ route('sip.main') }}" class="quick-action-btn bg-success text-white">
                            <i class="fas fa-plus-circle"></i> Create Procurement
                        </a>

                        <a href="{{ route('sip.main') }}" class="quick-action-btn bg-info text-white">
                            <i class="fas fa-file-pdf"></i> Generate Reports
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-7 mb-3">
                <div class="card dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fas fa-chart-line text-success"></i> Monthly Procurement Trend
                        </h5>
                    </div>

                    <div class="card-body">
                        <canvas id="monthlyChart" height="120"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 mb-3">
                <div class="card dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fas fa-chart-pie text-info"></i> Procurement Category Distribution
                        </h5>
                    </div>

                    <div class="card-body">
                        <canvas id="categoryChart" height="170"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-4 mb-3">
                <div class="card dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fas fa-percentage text-primary"></i> Budget Utilization
                        </h5>
                    </div>

                    <div class="card-body">
                        @php
                            $budgetAllocation = $budgetAllocation ?? 0;
                            $usedAmount = $totalAmount ?? 0;
                            $utilization = $budgetAllocation > 0 ? ($usedAmount / $budgetAllocation) * 100 : 0;
                            $utilization = $utilization > 100 ? 100 : $utilization;
                        @endphp

                        <div class="mini-stat mb-3">
                            <div class="mini-stat-title">Allocated Budget</div>
                            <div class="mini-stat-value">₱{{ number_format($budgetAllocation, 2) }}</div>
                        </div>

                        <div class="mini-stat mb-3">
                            <div class="mini-stat-title">Used Amount</div>
                            <div class="mini-stat-value">₱{{ number_format($usedAmount, 2) }}</div>
                        </div>

                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: {{ $utilization }}%;">
                                {{ number_format($utilization, 0) }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-3">
                <div class="card dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fas fa-clock text-success"></i> Recent Procurements
                        </h5>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($recentProcurements as $procurement)
                                    <tr>
                                        <td>
                                            <span class="badge badge-primary">
                                                {{ $procurement->code }}
                                            </span>
                                        </td>
                                        <td>{{ $procurement->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($procurement->created_at)->format('M d, Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">
                                            No recent procurement found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const quarterCtx = document.getElementById('quarterChart');

    new Chart(quarterCtx, {
        type: 'bar',
        data: {
            labels: ['Q1', 'Q2', 'Q3', 'Q4'],
            datasets: [{
                label: 'Allocation Amount',
                data: [
                    {{ $quarterAmounts['Q1'] ?? 0 }},
                    {{ $quarterAmounts['Q2'] ?? 0 }},
                    {{ $quarterAmounts['Q3'] ?? 0 }},
                    {{ $quarterAmounts['Q4'] ?? 0 }}
                ],
                borderWidth: 1,
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const monthlyCtx = document.getElementById('monthlyChart');

    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Monthly Amount',
                data: [
                    {{ $monthlyAmounts[1] ?? 0 }},
                    {{ $monthlyAmounts[2] ?? 0 }},
                    {{ $monthlyAmounts[3] ?? 0 }},
                    {{ $monthlyAmounts[4] ?? 0 }},
                    {{ $monthlyAmounts[5] ?? 0 }},
                    {{ $monthlyAmounts[6] ?? 0 }},
                    {{ $monthlyAmounts[7] ?? 0 }},
                    {{ $monthlyAmounts[8] ?? 0 }},
                    {{ $monthlyAmounts[9] ?? 0 }},
                    {{ $monthlyAmounts[10] ?? 0 }},
                    {{ $monthlyAmounts[11] ?? 0 }},
                    {{ $monthlyAmounts[12] ?? 0 }}
                ],
                borderWidth: 3,
                tension: .35,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const categoryCtx = document.getElementById('categoryChart');

    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($categoryLabels ?? []) !!},
            datasets: [{
                data: {!! json_encode($categoryAmounts ?? []) !!},
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

@endsection
