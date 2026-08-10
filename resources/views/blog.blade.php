@extends('layout')

@section('title')
    บทความ
@endsection

@section('content')
    <h2>บทความทั้งหมด</h2>
    <table class="table table-bordered text-center">
        <thead class="table-info">
            <tr>
                <th scope="col">Title</th>
                {{-- <th scope="col">Content</th> --}}
                <th scope="col">Status</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blog as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    {{-- <td>{{ $item->content }}</td> --}}
                    <td>
                        @if ($item->status == 'active')
                            <span class="btn btn-outline-success" style="padding: 5px 15px; min-width: 150px;">เผยแพร่</span>
                        @else
                            <span class="btn btn-outline-danger"
                                style="padding: 5px 15px; min-width: 150px;">ไม่เผยแพร่</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('book.delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('คุณต้องการลบบทความนี้หรือไม่')">
                                <i class="bi bi-trash-fill" style="color: white"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a class="btn btn-dark" href="{{ route('form') }}">+ เขียนบทความ</a>
@endsection
