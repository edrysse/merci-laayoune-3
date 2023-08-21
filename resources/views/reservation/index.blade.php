@extends('Admins.indexAdmin')
@section('content')


<style>
    td .btn {
        width: 90px;
    }
    .td-btn {
        /* position: absolute; */
        align-items: center;
    }
    @media screen and (max-width: 992px){
        td {
            position: relative !important;
            
        } 
        td .btn {
        width: 100%;
    }
    .td-btn {
        /* position: absolute; */
        align-items: stretch;
    }
    }
</style>


    <div class="container">
        <br>
        <br>
        <br>
        <br>
        <section class="mb-5"
            style="background-image: url(clientpage/images/28414724.jpg); padding: 5em 0em;">
            <h2 class="tit6 t-center" style="    font-size: 3rem;
            text-align: center;
            text-shadow: 0px 0 20px black;">
                RESERVATIONS
            </h2>
        </section>
        <div class="">
            {{-- <h1 style="color: black">All reservations</h1> --}}
            <a class="btn btn-primary btn-lg p-3" href="{{ route('reservation.create') }}" role="button">ajouter réservation</a>
            {{-- <a class="btn btn-danger btn-lg" href="{{ route('reservation.Trashed') }}" role="button">trashed<i
                    class="fa-solid fa-trash"></i></a> --}}

        </div>
        @if ($reservations->count() > 0)
            <table class="table" >
                <thead>
                    <tr>
                        <th scope="col">date</th>
                        <th scope="col">time</th>
                        <th scope="col">people</th>
                        <th scope="col">name</th>
                        <th scope="col">phone</th>
                        <th scope="col" style="width:300px">email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $item)
                        <tr>
                            <td data-label="date"  style="border-top: 0px;">{{ $item->date }}</td>
                            <td data-label="heure"  style="border-top: 0px;">{{ $item->heure }}</td>
                            <td data-label="puople"  style="border-top: 0px;">{{ $item->gens }}</td>
                            <td data-label="name" style="white-space: wrap; border-top: 0px;" >{{ $item->nom }}</td>
                            <td data-label="phone"  style="border-top: 0px;">{{ $item->phone }}</td>
                            <td data-label="email"  style="border-top: 0px; overflow:auto;">{{ $item->email }}</td>

                            <td style="display: flex;flex-direction: column; border-top: 0px;" class="td-btn"><a class="btn btn-success" href="{{ route('reservation.edit', $item->id) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>&nbsp;
                            
                             <a class="btn btn-primary" href="{{ route('reservation.show', $item->id) }}"><i
                                        class="fa-solid fa-eye fa-1x"></i></a>&nbsp;
                            
                                <form action="{{ route('reservation.destroy', $item->id) }}" method="post">
                                    <button type="submit" class="btn btn-danger">delete</button>
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $reservations->links() }}
            @if ($msg = Session::get('succes'))
                <div class="alert alert-success">
                    {{ $msg }}
                </div>
            @endif
            
    </div>
@else
    <div class="alert alert-danger">no reservations</div>
    @endif

@endsection
