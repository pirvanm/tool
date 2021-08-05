@extends('layouts.app')

@section('custom-css')
<style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: 'Nunito', sans-serif;
                height: 100vh;
            }

            .container {
                max-width: 
            }

            .survey__container {
                background-color: #fff;
                text-align: center;
                margin-top: 10rem;
                color: #fff;
                background-color: #aaa;
                padding: 1rem;
                width: 50%;
                margin-left: auto;
                margin-right: auto;
            }

            @media screen and (max-width: 1024px) {
                .survey__container {
                    width: 80%;
                }
            }

            @media screen and (max-width: 540px) {
                .survey__container {
                    width: 95%;
                }
            }

            .survey__title {
                color: #fff;
                font-size: 3rem;
            }

            .survey__form {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }
            
            .form__group {
                display: flex;
                gap: .5rem;
                align-items: center;
            }

            .form__input {
                padding: .6rem;
                outline: none;
                border: none;
                border-radius: .6rem;
                background-color: #eee;
            }

            .form__input:focus {
                background-color: #fff;
            }

            .form__button {
                padding: .8rem;
                outline: none;
                border: none;
                background-color: teal;
                color: #fff;
                font-size: 1rem;
                cursor: pointer;
                border-radius: .6rem;
            }

        </style>
@endsection

@section('content')
<div class="container">
            <div class="survey__container">
            <h1 class="survey__title">Survey Tool</h1>
                <form action="{{ route('survey.store') }}" method="POST" class="survey__form">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('message'))
                    <div class="alert alert-success">
                            <ul>
                                <li>{{ session('message') }}</li>
                            </ul>
                        </div>
                    @endif
                    <div class="form__group">
                        <label for="" class="form__label">Name</label>
                        <input type="text" name="name" placeholder="Your name..."  class="form__input">
                    </div>
                    <div class="form__group">
                        <label for="" class="form__label">Email</label>
                        <input type="email" name="email" placeholder="Your email..." class="form__input">
                    </div>
                    <div class="form__group">
                        <label for="" class="form__label">Favourite color 1</label>
                        <input type="color" name="color1" list="presets"></label>
                            <datalist id="presets">
                            <option value="#c22e3c">#c22e3c</option>
                            <option value="#5f1994">#5f1994</option>
                            <option value="#6699cc">#6699cc</option>
                            <option value="#f03b0b">#f03b0b</option>
                            <option value="#4b0bf1">#4b0bf1</option>
                            <option value="#494e7d">#494e7d</option>
                            <option value="#11e6a9">#11e6a9</option>
                            <option value="#aca92d">#aca92d</option>
                            <option value="#f44970">#f44970</option>
                            <option value="#1bc142">#1bc142</option>
                        </datalist>
                    </div>
                    <div class="form__group">
                        <label for="" class="form__label">Favourite color 1</label>
                        <input type="color" name="color2" list="presets"></label>
                            <datalist id="presets">
                            <option value="#c22e3c">#c22e3c</option>
                            <option value="#5f1994">#5f1994</option>
                            <option value="#6699cc">#6699cc</option>
                            <option value="#f03b0b">#f03b0b</option>
                            <option value="#4b0bf1">#4b0bf1</option>
                            <option value="#494e7d">#494e7d</option>
                            <option value="#11e6a9">#11e6a9</option>
                            <option value="#aca92d">#aca92d</option>
                            <option value="#f44970">#f44970</option>
                            <option value="#1bc142">#1bc142</option>
                        </datalist>
                    </div>
                    <div class="form__group">
                        <label for="" class="form__label">Favourite color 1</label>
                        <input type="color" name="color3" list="presets"></label>
                            <datalist id="presets">
                            <option value="#c22e3c">#c22e3c</option>
                            <option value="#5f1994">#5f1994</option>
                            <option value="#6699cc">#6699cc</option>
                            <option value="#f03b0b">#f03b0b</option>
                            <option value="#4b0bf1">#4b0bf1</option>
                            <option value="#494e7d">#494e7d</option>
                            <option value="#11e6a9">#11e6a9</option>
                            <option value="#aca92d">#aca92d</option>
                            <option value="#f44970">#f44970</option>
                            <option value="#1bc142">#1bc142</option>
                        </datalist>
                    </div>
                    <div class="form__group">
                        <span><img src="http://127.0.0.1:8000/captcha/default?aLyRSNgM" ></span>
                    </div>
                    <div class="form__group">
                        <input id="captcha" type="text" placeholder="Enter Captcha" name="captcha" class="form__input">
                    </div>
                    <div class="form__group">
                        <button type="submit" class="form__button">Send</button>
                    </div>
                </form>
            </div>
        </div>
@endsection
