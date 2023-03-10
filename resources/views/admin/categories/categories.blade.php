@extends('admin.master.master-page')

@section('head-title', 'Categorii')

@section('big-title', 'Categorii')

@section('content')
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Titlu:</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->title }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
@endsection
