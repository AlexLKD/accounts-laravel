@extends('page')
@section('content')
<div class="container">
    <section class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
            <h2 class="my-0 fw-normal fs-4">Solde aujourd'hui</h2>
        </div>
        <div class="card-body">
            <p class="card-title pricing-card-title text-center fs-1">{{$total}} €</p>
        </div>
    </section>

    <section class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
            <h1 class="my-0 fw-normal fs-4">{{$title}}</h1>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">Opération</th>
                        <th scope="col" class="text-end">Montant</th>
                        <th scope="col" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td width="50" class="ps-3">
                            @if ($transaction->categorie !== null)
                            <i class="bi bi-{{ $transaction->categorie->icon }} fs-3"></i>
                            @endif


                        </td>
                        <td>
                            <time datetime="2023-07-10" class="d-block fst-italic fw-light">{{$transaction->date_transaction}}</time>
                            {{$transaction->name}}
                        </td>
                        <td class="text-end">
                            <?php
                            if (str_contains($transaction['amount'], "-")) {
                                echo '<span class="rounded-pill text-nowrap bg-warning-subtle px-2">';
                                echo $transaction['amount'];
                            } else {
                                echo '<span class="rounded-pill text-nowrap bg-success-subtle px-2">';
                                echo '+' . $transaction['amount'];
                            }
                            ?>
                            <!-- 
                            <span class="rounded-pill text-nowrap bg-warning-subtle px-2">
                                {{$transaction->amount}} €
                            </span> -->
                        </td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('transactions.edit', ['id' => $transaction->id]) }}" class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('transactions.destroy', ['id' => $transaction->id]) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <nav class="text-center">
                <ul class="pagination d-flex justify-content-center m-2">
                    <li class="page-item disabled">
                        <span class="page-link">
                            <i class="bi bi-arrow-left"></i>
                        </span>
                    </li>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">Juillet 2023</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="index.html">Juin 2023</a>
                    </li>
                    <li class="page-item">
                        <span class="page-link">...</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="index.html">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
</div>
@endsection