@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register2') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address[]" value="{{ old('address') }}" autocomplete="address" autofocus required></textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="address" class="col-md-4 col-form-label text-md-right"></label>
                          <div class="col-md-3">
                              <select class="form-control @error('birth_date') is-invalid @enderror" name="">
                                <option value="">City</option>
                              </select>

                              @error('address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>

                          <div class="col-md-3">
                              <select class="form-control @error('birth_date') is-invalid @enderror" name="">
                                <option value="">Province</option>
                              </select>

                              @error('address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="address" class="col-md-4 col-form-label text-md-right"></label>
                          <div class="col-md-6">
                              <select class="form-control @error('birth_date') is-invalid @enderror" name="">
                                <option value="">Country</option>
                              </select>

                              @error('address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('Birth Date') }}</label>

                            <div class="col-md-6">
                                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{date('Y-m-d')}}" required>

                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="membership" class="col-md-4 col-form-label text-md-right">{{ __('Membership') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('membership') is-invalid @enderror" name="membership" id="membership" required>
                                  @foreach ($memberships as $membership)
                                      <option value="{{ $membership->id }}">{{ $membership->name }}</option>
                                  @endforeach
                                </select>

                                @error('membership')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="card_number" class="col-md-4 col-form-label text-md-right">{{ __('Credit Card Number') }}</label>

                            <div class="col-md-6">
                                <input id="card_number" type="text" class="form-control @error('card_number') is-invalid @enderror" name="card_number" required>

                                @error('card_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expiration" class="col-md-4 col-form-label text-md-right">{{ __('Expiration') }}</label>

                            <div class="col-md-4">
                                <select name="card_month" id="card_month" class="form-control @error('card_month') is-invalid @enderror" required>
                                  @php
                                    for ($i = 0; $i < 12; $i++) {
                                      $month_str = date('F', strtotime("+ $i month"));
                                      $month_v = date('m', strtotime("+ $i month"));
                                      echo "<option value=$month_v>".$month_str ."</option>";
                                    }
                                  @endphp
                                </select>
                                @error('card_month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                              <select name="card_year" id="card_year" class="form-control @error('card_year') is-invalid @enderror" required>
                                @php
                                  for ($j = 2000; $j < date('Y')+20; $j++) {
                                    echo "<option value=".$j." ".(($j == date('Y'))?"selected":'').">".$j."</option>";
                                  }
                                @endphp
                              </select>
                              @error('card_year')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="card_cvv" class="col-md-4 col-form-label text-md-right">{{ __('CVV') }}</label>

                            <div class="col-md-2">
                                <input id="card_cvv" type="number" class="form-control @error('card_cvv') is-invalid @enderror" name="card_cvv" required>

                                @error('card_cvv')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                              <img src="image/visa.jpg" alt="" style="height:37px; margin-right:5px;">
                              <img src="image/mastercard.jpg" alt="" style="height:37px; margin-right:5px;">
                              <img src="image/amex.jpg" alt="" style="height:37px;">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
