@extends('client.layout')
@section('content')
    <base href="/public">
    @include('client.includes.aside')
    <section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15"
        style="background-image: url(clientpage/images/bg-title-page-03.jpg);">
        <h2 class="tit6 t-center">
            Pannier
        </h2>
    </section>
    <br><br><br>
    <div class="container">
        <br><br><br>
<style>
    .total {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        margin-bottom: 6em;
        margin-top: 1em;
    }
    .total .t {
        /* padding-right: 5em; */
        margin-bottom: 5px;
    }
    .button {
        display: flex;
    }
    span{
    display:block;
    width:256px; /*or whatever width you want the effect of <hr>*/
    border-top: 1px solid #ccc
    }
</style>

        <table class="pannier">
                <thead class="pannier">
                <tr class="pannier">
                    <th scope="col" class="pannier">photo</th>
                    <th scope="col" class="pannier">repas</th>
                    <th scope="col" class="pannier">prix</th>
                    <th scope="col" class="pannier">quantite</th>
                    <th scope="col" class="pannier">subtotal</th>
                    <th scope="col" class="pannier">delete</th>
                </tr>
                </thead>
                <tbody class="pannier">
            @php
            $total = 0;
            @endphp
            @foreach ($cartItems as $cartItem)
                @php
                $total += $cartItem->price * $cartItem->qty;
                @endphp
            <tr data-id="{{ $cartItem->id }}" class="pannier">
                <td data-label="photo" style="display: flex;justify-content: center;" >
                    <img src="{{ $cartItem->model->image }}" class="img-fluid pannier" style="width: 150px;" alt="">
                </td>
                <td data-label="repas" class="pannier">{{ $cartItem->name }}</td>
                <td data-label="prix" class="pannier">
                    {{ $cartItem->price }} DHS
                </td>
                <td data-label="quantite" class="pannier">
            
                    <form action="{{ route('pannier.update', $cartItem->rowId) }}" method="post">

                        <div class="increment">
                            <div class="number-input">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" type="button"></button>
                                <input class="quantity" min="1" name="qty" value="{{ $cartItem->qty }}" type="number">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus" type="button"></button>

                            </div>
                            <button type="submit" class="btn btn-outline-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" 
                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                        </div>
                        @csrf
                        @method('put')
                    </form>
                </td>
                    <td data-label="subtotal" class="pannier">
                        {{ $cartItem->price * $cartItem->qty }} DHS
                    </td>
                    <td data-label="delete" class="actions pannier" data-th="">
                        <form action="{{ route('pannier.destroy', $cartItem->rowId) }}" method="post">
                            <button type="submit" class="btn btn-outline-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                            </button>
                            @csrf
                            @method('DELETE')
                        </form>
            
                    </td>

            </tr>
            @endforeach
        </tbody>
        {{-- <tfoot>
            <tr class="pannier">
                <td colspan="4" >
                    
                </td>
                <td colspan="2" class="d-flex justify-content-between p-2 mb-2 " style="background-color: #e1f5fe;">
                    <h5 class="fw-bold mb-0">Total:</h5>
                    <h5 class="fw-bold mb-0">{{ $total }} DHS</h5>
                </td>
            </tr>
            
        </tfoot> --}}
        </table>
        <div class="total">
            <div class="t">
                <h5 class="fw-bold mb-0">Total: {{ $total }} DHS</h5>
                <span></span>
            </div>
        
            <div class="button">
                <div class="mr-3">
                    {{-- <a href="clientMenu" class="btn btn-link text-muted ContinueSH">
                        <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a> --}}
                    <a href="clientMenu" class="btn3 flex-c-m size13 txt11 trans-0-4"> <i class="mdi mdi-arrow-left me-1"></i> Retour au menu</a>
                </div>
                <div>
                    <a href="{{ route('comnd.create') }}" class="btn3 flex-c-m size13 txt11 trans-0-4" style="width: 90px">Valider</a>
                </div>
            </div>
            
        </div>
        
        
    </div>






@endsection