@extends('page')

@section('content')
@csrf
<div class="container">
    <section class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
            <h1 class="my-0 fw-normal fs-4">Catégories</h1>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach ($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        @if ($category->icon !== null)
                        <i class="bi bi-{{ $category->icon }} fs-3"></i>
                        @endif
                        &nbsp;
                        {{$category->name}}
                        &nbsp;
                        @if ($category->transactions !== null)
                        <span class="badge bg-secondary">{{$category->transactions->count()}} opérations</span>
                        @else
                        <span class="badge bg-secondary">0 opérations</span>
                        @endif

                    </div>
                    <div>
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
            <h2 class="my-0 fw-normal fs-4">Ajouter une catégorie</h2>
        </div>
        <div class="card-body">
            <form class="row align-items-end">
                <div class="col col-md-5">
                    <label for="name" class="form-label">Nom *</label>
                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>" id="token-csrf">
                    <input type="email" class="form-control" name="name" id="name" required>
                </div>
                <div class="col-md-5">
                    <label for="icon" class="form-label">Classe icone bootstrap *</label>
                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>" id="token-csrf">
                    <input type="text" class="form-control" name="icon" id="icon" required>
                </div>
                <div class="col col-md-2 text-center text-md-end mt-3 mt-md-0">
                    <button type="submit" class="btn btn-secondary">Ajouter</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection