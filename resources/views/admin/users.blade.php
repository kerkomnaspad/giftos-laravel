@extends('main.main')
@section('content')

@if(!Auth::check() || Auth::user()->role !== 'admin')
    <?php    return redirect()->route('homePage'); ?>
@endif

@if(session('success'))
    <script>
        toastr.success('{{ session('success') }}');
    </script>
@endif

@if(session('error'))
    <script>
        toastr.error('{{ session('error') }}');
    </script>
@endif

<div class="panel panel-info">
    <div class="panel-heading">Users List</div>
    <div class="panel-body">
        <!-- <a href="{{ route('toggleAddItemForm') }}" class="btn btn-outline-success">
            + Add User
        </a> -->
        <div class="d-flex justify-content-between align-items-center">

            <div class="text-left px-6">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination px-6">
                    @if ($users->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">&laquo;</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ $users->previousPageUrl() . '&page=' . $users->currentPage() - 1 }}"
                                tabindex="-1">&laquo;</a>
                        </li>
                    @endif

                    @foreach ($users->links()->elements[0] as $page => $url)
                        @if ($page == $users->currentPage())
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url . '&page=' . $page }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ $users->nextPageUrl() . '&page=' . $users->currentPage() + 1 }}">&raquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-disabled="true">&raquo;</a>
                        </li>
                    @endif
                </ul>
            </nav>


        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="sortable-header">
                        <a href="{{ route('aitems', ['sortBy' => 'id', 'order' => ($sortBy === 'id' && $order === 'asc') ? 'desc' : 'asc'] + request()->except('page')) }}"
                            class="sortable-link">
                            <span>UserID</span>
                            <span
                                class="sort-arrow">{!! $sortBy === 'id' ? ($order === 'asc' ? '↑' : '↓') : '' !!}</span>
                        </a>
                    </th>

                    <th scope="col">Image</th>
                    <th scope="col" class="sortable-header">
                        <a href="{{ route('aitems', ['sortBy' => 'name', 'order' => ($sortBy === 'name' && $order === 'asc') ? 'desc' : 'asc'] + request()->except('page')) }}"
                            class="sortable-link">
                            <span>Name</span>
                            <span
                                class="sort-arrow">{!! $sortBy === 'name' ? ($order === 'asc' ? '↑' : '↓') : '' !!}</span>
                        </a>
                    </th>

                    <th scope="col" class="sortable-header">
                        <a href="{{ route('aitems', ['sortBy' => 'type_id', 'order' => ($sortBy === 'type_id' && $order === 'asc') ? 'desc' : 'asc'] + request()->except('page')) }}"
                            class="sortable-link">
                            <span>Email</span>
                            <span
                                class="sort-arrow">{!! $sortBy === 'type_id' ? ($order === 'asc' ? '↑' : '↓') : '' !!}</span>
                        </a>
                    </th>

                    <!-- <th scope="col" class="sortable-header">
                        <a href="{{ route('aitems', ['sortBy' => 'quantity', 'order' => ($sortBy === 'quantity' && $order === 'asc') ? 'desc' : 'asc'] + request()->except('page')) }}"
                            class="sortable-link">
                            <span>Quantity</span>
                            <span
                                class="sort-arrow">{!! $sortBy === 'quantity' ? ($order === 'asc' ? '↑' : '↓') : '' !!}</span>
                        </a>
                    </th>

                    <th scope="col" class="sortable-header">
                        <a href="{{ route('aitems', ['sortBy' => 'price', 'order' => ($sortBy === 'price' && $order === 'asc') ? 'desc' : 'asc'] + request()->except('page')) }}"
                            class="sortable-link">
                            <span>Price</span>
                            <span
                                class="sort-arrow">{!! $sortBy === 'price' ? ($order === 'asc' ? '↑' : '↓') : '' !!}</span>
                        </a>
                    </th>-->
                    <th scope="col" class="sortable-header">
                        <a href="{{ route('aitems', ['sortBy' => 'created_at', 'order' => ($sortBy === 'created_at' && $order === 'asc') ? 'desc' : 'asc'] + request()->except('page')) }}"
                            class="sortable-link">
                            <span>Created At</span>
                            <span
                                class="sort-arrow">{!! $sortBy === 'created_at' ? ($order === 'asc' ? '↑' : '↓') : '' !!}</span>
                        </a>
                    </th>
                    <th scope="col" class="sortable-header">
                        <a href="{{ route('aitems', ['sortBy' => 'updated_at', 'order' => ($sortBy === 'updated_at' && $order === 'asc') ? 'desc' : 'asc'] + request()->except('page')) }}"
                            class="sortable-link">
                            <span>Updated At</span>
                            <span
                                class="sort-arrow">{!! $sortBy === 'updated_at' ? ($order === 'asc' ? '↑' : '↓') : '' !!}</span>
                        </a>
                    </th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(session('showAddItemForm'))
                    <tr class="collapsible-row">
                        <form action="{{ route('storeItem') }}" method="POST" enctype="multipart/form-data"
                            id="addItemForm">
                            @csrf <!-- CSRF token for security -->
                            <td>{{ $nextId }}</td> <!-- Display the calculated next ID -->
                            <td>
                                <input type="file" name="image" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="name" class="form-control" placeholder="John" required>
                            </td>
                            <!-- <td>
                                <select name="type_id" class="form-select" required>
                                    <option value="" disabled selected>Select Item Type</option>
                                    @foreach ($itemTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </td> -->
                            <td>
                                <input type="email" name="email" class="form-control" placeholder="test@example.com" required>
                            </td>
                            <!-- <td>
                                <input type="text" name="price" class="form-control" placeholder="5900000" required>
                            </td> -->
                            <td>
                                When submit
                            </td>
                            <td>
                                is pressed &#8594;
                            </td>
                            <td>
                                <!-- Hidden input to store the description -->
                                <input type="hidden" name="description" id="descriptionHidden">
                                <button type="submit" class="btn btn-outline-primary">Submit</button>
                            </td>
                        </form>
                    </tr>
                    <!-- <tr class="collapsible-row">
                        <td colspan="9">
                            <h3>Description</h3>
                            <textarea id="descriptionTextarea" class="form-control"
                                placeholder="Enter item description here..." rows="3" required></textarea>
                        </td>
                    </tr> -->
                @endif


                @foreach ($users as $item)
                    @if(!$users->isEmpty()) <!-- Check if the related item exists -->
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}"
                                    alt="{{ $item->name }}"
                                    style="max-width: 100%; max-height: 10rem; height: auto; object-fit: contain;">

                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <!-- <td>{{ $item->quantity }}</td> -->
                            <!-- <td>Rp {{ number_format($item->price, 2, ',', '.') }}</td> -->
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d F Y H:i:s') }}</td>
                            <td>
                                <div class="d-flex flex-column col gap-1">
                                    <form action="return false;">
                                        <a href="{{ route('toggleEditUserForm', ['id' => $item->id, 'page' => $users->currentPage()]) }}"
                                            class="btn btn-outline-warning">
                                            Edit
                                        </a>




                                    </form>
                                    <form action="{{ route('deleteUser', ['id' => $item->id, 'page' => $users->currentPage()]) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>


                                </div>
                            </td>
                        </tr>
                        @if(session('editUserForm')== $item->id)
                            <tr class="collapsible-row">
                                <form action="{{ route('updateUser', ['id' => $item->id, 'page' => $users->currentPage()]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <td>{{ $item->id }}</td> <!-- Display the current ID -->
                                    <td>
                                        <input type="file" name="image" class="form-control" value="{{ $item->image }}">
                                    </td>
                                    <td>
                                        <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                                    </td>

                                    <td>
                                        <input type="email" name="email" class="form-control" value="{{ $item->email }}"
                                            required>
                                    </td>
                                    <!-- <td>
                                        <input type="text" name="price" class="form-control" value="{{ $item->price }}" required>
                                    </td> -->
                                    <td>
                                        Save
                                    </td>
                                    <td>
                                        Changes &#8594;
                                    </td>
                                    <td>

                                        <button type="submit" class="btn btn-outline-primary">Save Changes</button>

                                    </td>
                                </form>
                            </tr>
                            <tr class="collapsible-row">
                                <td colspan="9">
                                    <!-- Cancel button as a separate form -->
                                    <form action="{{ route('cancelEditUserForm') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger w-100">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        @endif

                    @else
                        <tr>
                            <td colspan="5">Item not found</td>
                        </tr>
                    @endif


                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('addItemForm').addEventListener('submit', function () {
        const descriptionTextarea = document.getElementById('descriptionTextarea');
        const descriptionHidden = document.getElementById('descriptionHidden');
        descriptionHidden.value = descriptionTextarea.value;
    });

</script>
@endsection