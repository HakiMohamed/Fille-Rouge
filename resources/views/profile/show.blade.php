
@extends('layouts.app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger mt-5">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(request()->query('alertCompleterProfile') !== null)
@if( $user->role->id != 2 || $user->role->id != 3)
<div class="card-header shadow-lg justify-content-center fw-bold align-items-center px-5 mt-5 py-4" style="background-color: #ff9900c8;">
  <h6 class="card-title text-lg text-white font-bold fw-bold mb-2">Veuillez compléter votre profil pour bénéficier des options du rôle d'agent immobilier Pour partager vos biens immobilier. "CIN, Numéro de téléphone, Adresse, Pièce d'identité". Ajoutez votre numéro de téléphone pour que nous puissions vous contacter.</h6>
  <h6 class="card-title text-lg text-white font-bold fw-bold mb-0">Après que vous ayez ajouté votre numéro de téléphone, nous pourrons vous appeler directement pour valider votre demande et discuter de questions ou pour vous fournir un soutien personnalisé pour accélérer vos services immobiliers Où vendre votre bien.</h6>
</div>
@endif
@endif

@if($user->role->id == 3 && $user->phone != null)

<div class="card-header d-flex justify-content-center fw-bold align-items-center px-5 mt-5 py-4" style="background-color: #03544bc8;">
 <a class="text-center" href="#PropertiesSection1"> <h5 class="card-title text-lg text-white font-bold fw-bold mb-0">Voir la liste de vos propriétés </h5> Click ici </a>
</div>
@endif
<div class="container mt-5 mb-5">
  <div class="row ">
    <div class="col-md-12">
      <div class="card rounded-lg shadow border-0 bg-white mb-4">
          <div class="card-header d-flex justify-content-between align-items-center px-6 py-4" style="background-color: #00b98ec8;">
              <h5 class="card-title text-white fw-bold text-lg font-bold mb-0">Votre Profil</h5>
              @if(session('success'))
                  <div class="alert alert-success" role="alert">
                      {{ session('success') }}
                  </div>
              @endif
          </div>
          <div class="card-body px-6 py-4">
              <div class="row align-items-center">
                  <div class="col-md-3 text-center">
                          <img src="{{ $user->avatar ? asset($user->avatar) : asset('images/downloadprofile.png')}}" alt="Current Avatar" class="rounded-full object-cover" style="height: 200px; width: 200px; margin-bottom: 1rem; border-radius: 50%;">
                  </div>
                  <div class="col-md-9">

                    

                      <div class="row">
                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="text-sm font-medium fw-bold">Prénom</label>
                                  <p>{{ $user->firstname }}</p>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="text-sm font-medium fw-bold">Nom</label>
                                  <p>{{ $user->lastname }}</p>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="text-sm font-medium fw-bold">Téléphone</label>
                                  <p>{{ $user->phone }}</p>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="text-sm font-medium fw-bold">CIN</label>
                                  <p>{{ $user->CIN }}</p>
                              </div>
                          </div>
                      </div>
                      <div class="mb-3">
                          <label class="text-sm font-medium fw-bold">Adresse</label>
                          <p>{{ $user->Adresse }}</p>
                      </div>
                      <div class="mb-3">
                          <label class="text-sm font-medium fw-bold">Email</label>
                          <p>{{ $user->email }}</p>
                      </div>
                      <div class="mb-3 d-flex justify-content-between">
                    
                        
                        <div class="">
                            <p class=" fw-bold" >Recto de la carte d'identité</p>

                            <span class="text-small text-muted fw-small">{{ $user->RectoIdentite ? "" : "exemple :"}}</span>

                            <img src="{{ $user->RectoIdentite ? asset($user->RectoIdentite) : asset('images/RectoCatre.jpg') }}" alt="Recto de la carte d'identité" class="img-thumbnail  mb-3" style="height: 130px; width: 200px;">
                            
                      </div>
                        <div class="">
                            <p class=" fw-bold" >Verso de la carte d'identité</p>
                            <span class="text-small text-muted fw-small">{{ $user->VersoIdentite ? "" : "exemple :"}}</span>
                            <img src="{{  $user->RectoIdentite ?  asset($user->VersoIdentite) : asset('images/VersoCatre.jpg') }}" alt="Verso de la carte d'identité" class="img-thumbnail  mb-3" style="height: 130px; width: 200px;">
                            
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  

  
    <div class="col-md-12">
      <div class="card rounded-lg shadow border-0 bg-white">
          <div class="card-header d-flex justify-content-between align-items-center px-6 py-4" style="background-color: #00b98ec8;">
              <h5 class="card-title text-lg text-white fw-bold font-bold mb-0">Edit Votre Profile</h5>
          </div>
          <div class="card-body px-6">
              <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
  
                  <div class="mb-3">
                      <label for="firstname" class="form-label text-sm font-medium fw-bold">Firstname<span class="text-danger">*</span></label>
                      <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname', $user->firstname) }}" required >
                      @error('firstname')
                      <span class="text-xs text-danger mt-2">{{ $message }}</span>
                      @enderror
                  </div>
  
                  <div class="mb-3">
                      <label for="lastname" class="form-label text-sm font-medium fw-bold">Lastname<span class="text-danger">*</span></label>
                      <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
                      @error('lastname')
                      <span class="text-xs text-danger mt-2">{{ $message }}</span>
                      @enderror
                  </div>
  
                  <div class="mb-3">
                      <label for="phone" class="form-label text-sm font-medium fw-bold">Phone<span class="text-danger">*</span></label>
                      <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}">
                      @error('phone')
                      <span class="text-xs text-danger mt-2">{{ $message }}</span>
                      @enderror
                  </div>
  
                  <div class="mb-3">
                      <label for="CIN" class="form-label text-sm font-medium fw-bold">CIN  <span class="text-muted text-small">Carte National d'edentité</span><span class="text-danger">*</span></label>
                      <input id="CIN" type="text" class="form-control @error('CIN') is-invalid @enderror" name="CIN" value="{{ old('CIN', $user->CIN) }}">
                      @error('CIN')
                      <span class="text-xs text-danger mt-2">{{ $message }}</span>
                      @enderror
                  </div>
  
                  <div class="mb-3">
                      <label for="Adresse" class="form-label text-sm font-medium fw-bold">Adresse<span class="text-danger">*</span></label>
                      <input id="Adresse" type="text" class="form-control @error('Adresse') is-invalid @enderror" name="Adresse" value="{{ old('Adresse', $user->Adresse) }}">
                      @error('Adresse')
                      <span class="text-xs text-danger mt-2">{{ $message }}</span>
                      @enderror
                  </div>
  
                  <div class="mb-3 ">
                      <label for="email" class="form-label d-block text-sm font-medium fw-bold">Email<span class="text-danger">*</span></label>
                      <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}">
                      @error('email')
                      <span class="text-xs text-danger mt-2">{{ $message }}</span>
                      @enderror
                  </div>
                  <label for="avatar" class="form-label text-sm font-medium fw-bold">Photo de profile <span class="text-success mb-5 " style="font-size: 10px; "> optionel</span></label>

                  <div class="mb-3">
                    <input id="avatar" type="file" class="custom-file-input form-control-file @error('avatar') is-invalid @enderror" name="avatar">
                    @error('avatar')
                    <span class="text-xs text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
  
                <label for="VersoIdentite" class="form-label  font-medium fw-bold">Verso de votre carte d'identité<span class="text-danger">*</span></label>

                  <div class="mb-3">
                      <input id="VersoIdentite" type="file" class="custom-file-input form-control-file @error('VersoIdentite') is-invalid @enderror" name="VersoIdentite">
                      @error('VersoIdentite')
                      <span class="text-xs text-danger mt-2">{{ $message }}</span>
                      @enderror
                  </div>
                  <label for="RectoIdentite" class="form-label  font-medium fw-bold">Recto de votre carte d'identité<span class="text-danger">*</span></label>

                  <div class="mb-3">
                      <input id="RectoIdentite" type="file" class=" custom-file-input form-control-file @error('RectoIdentite') is-invalid @enderror" name="RectoIdentite">
                      @error('RectoIdentite')
                      <span class="text-xs text-danger mt-2">{{ $message }}</span>
                      @enderror
                  </div>
  
                  <button id="PropertiesSection1" type="submit" class="btn btn-success mt-3 rounded-lg d-block mx-auto text-white font-bold">Enregistrer</button>
              </form>
          </div>
      </div>
  </div>
  
</div>
  </div>


  <div  class="card-header d-flex justify-content-center fw-bold align-items-center px-6 py-4" style="background-color: #00b98ec8;">
    <h5 class="card-title text-lg text-white font-bold fw-bold mb-0">Vos Properties</h5>
  </div>
<div  class="container-xxl py-4  border-2 shadow-lg" style="overflow-x: hidden;">
    <div class="container">
        @if (!isset($properties) || !count($properties))
        <tr>
            <td colspan="6" style="color: red;" class="text-center text-danger">Votre liste de properties est vide pour le moment, aller vers menu "Publier une annonce" et choisir ajouter le propertires qui vous interesse</td>
        </tr>
        @else  
        <div class="tab-content">
            <div  class="tab-pane fade show p-0 active">
            <div class="row g-4 shadow-0 align-items-stretch"  id="property-list">                
         @foreach ($properties as $property)
           <div class="col-lg-4 col-md-6  property-item   wow fadeInUp" style="height: 600px;"   data-wow-delay="0.1s">
            @if($property->Publication == "encoursTraitement")
            <small class="flex-fill text-center text-dark border-end py-2">Encour</small>

            @endif

            @if($property->Publication == "encoursTraitement")
            <small class="flex-fill text-center text-dark border-end py-2">Publier</small>

            @endif

              <div class="property-item rounded overflow-hidden">
                <div class="position-relative overflow-hidden"> 
                    <div id="carouselProperty{{ $property->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($property->images as $key => $image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset($image->url) }}" class="d-block w-100 " style=" height:300px; object-fit: cover;" alt="Property Image">
                                </div>
                            @endforeach
                        </div>
                        
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProperty{{ $property->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselProperty{{ $property->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div> 
                    <div style="background-color: rgba(135, 135, 135, 0.432);" class="rounded btn  btn-secodary  text-white position-absolute start-0 top-0 mx-2 mb-1 m-4 ">{{ $property->created_at->locale('fr')->diffForHumans() }}</div>
                    <div style="color: #00b98ec8; border-color: #00b98ec8; background-color:rgb(255, 255, 255);" class="rounded btn  btn-outline fw-bold    position-absolute end-0 top-0 m-4 py-1 px-3">{{ $property->categorie->name }}</div>
                    <div class="bg-white rounded-top  position-absolute start-0 fw-bold bottom-0 mx-4 pt-1 px-3" style="color: #4b13f3;">{{ $property->type->name }}</div>
                    
                </div>

                

                <div class="p-4 pb-0 position-relative" style="height: 200px;">
                    
                    <h5 class="fw-bold mb-1" style="color: #000000;"><span class="text-dark">{{ $property->prix }}</span>  MAD   @if($property->categorie->name =='A LOUER') /Mois @endif</h5>
                    <p class="d-block text-dark h5 mb-2">{{ $property->type->name }} {{$property->categorie->name}} à {{ $property->city->name }}</p>
                    <span class="d-flex justify-content-between "> 
                    <p class="text-dark"><i class="fa fa-map-marker-alt me-2" style="color: #4b13f3;"></i>{{ $property->city->name }}</p>
                    @if($property->caracteristiques->etage)
                    <span class="text-dark">  <i class="fa-solid fa-up-down me-2" style="color: #4b13f3;">  </i>   Etage :   {{$property->caracteristiques->etage}} </span>
                  @endif
              </span>
                     
                    <div class="d-flex " style="justify-content: space-between">
                        <a href="https://api.whatsapp.com/send?phone=+212641725930&amp;text=Bonjour, j'ai vu le bien mis  {{$property->categorie->name}} sur agency ({{ $property->type->name }} {{$property->categorie->name}} à {{ $property->city->name }}), Ref: 12_75MA{{$property->id}}, et je souhaite prendre rendez-vous pour une visite. Merci. %0a{{ route('property.showDetail', $property->id) }}" class="btn mb-1 d-flex justify-content-start btnwhatspp" data-tracking="click" data-value="listing-whatsapp" data-slug="495978" aria-label="Whatsapp" target="_blank" rel="noreferrer nofollow noopener"> 
                          Planifier visite  <i class="fa-brands fa-whatsapp fa-xl" style="color: #ffffff; margin-top:9px; margin-left:8px;"></i>
                        </a>
                                              
                        @if($property->type->name == 'Appartement' || $property->type->name == 'Studio'||$property->type->name == 'Bureau')
                        <a class="mt-2" href="{{ route('appartements.edit', $property->id) }}"><i class="fa-solid fa-pencil fa-lg"></i></a>
                        @elseif($property->type->name == 'Maison' || $property->type->name == 'Riad'||$property->type->name == 'Villa')
                        <a class="mt-2" href="{{ route('maisons.edit', $property->id) }}"><i class="fa-solid fa-pencil fa-lg"></i></a>
                        @elseif($property->type->name == 'Local Ecommerce')
                        <a class="mt-2" href="{{ route('localcommerces.update', $property->id) }}"><i class="fa-solid fa-pencil fa-lg"></i></a>
                        @elseif($property->type->name == 'Terrain Immobilier')
                        <a class="mt-2" href="{{ route('terrains-immobiliers.edit', $property->id) }}"><i class="fa-solid fa-pencil fa-lg"></i></a>
                        @elseif($property->type->name == 'Chambre')
                        <a class="mt-2" href="{{ route('chambres.edit', $property->id) }}"><i class="fa-solid fa-pencil fa-lg"></i></a>
                        @endif
                        <form method="POST" action="{{ route('properties.destroy', $property->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Vous etes sure vous voulez supprimer votre {{$property->type->name}}  ?')" class="btn "><i class="fa-solid fa-trash-can fa-lg" style="color: red; margin-bottom:5px;"></i></button>
                        </form>
                        


                    </div>
                    
                    <div class="favorite-icon position-absolute top-0 end-0 m-3">
                        @guest
                            <a href="{{ route('login') }}" class="btn">
                                <i class="fas fa-heart fa-2xl" style="color: #c1bebe;"></i>
                            </a>
                        @else
                        <span class="d-flex">
                        <span id="favoriteCount">{{ $property->favoritedBy()->count() }}</span> 
                            <form id="toggleFavoriteForm{{$property->id}}" action="{{ route('favorite-properties.toggle', ['propertyId' => $property->id]) }}" method="POST">
                                @csrf
                                <button type="button" class="heart-btn btn">
                                    <i class="fas fa-heart fa-2xl" style="color: {{ Auth::user()->favoriteProperties->contains($property) ? 'red' : '#c1bebe' }};"></i>
                                </button>
                            </form>
                        </span>
                        @endguest
                    </div>
                    
                </div>

                <div class="d-flex border-top" style="height: 50px; background-color:rgb(255, 255, 255);">
                    <small class="flex-fill text-center text-dark border-end py-2"><i class="fa fa-ruler-combined me-2" style="color: #4b13f3;"></i>{{ $property->caracteristiques->surface }} @if($property->type->name =='Terrain Immobilier') Ha @else m² @endif</small>
                    <small class="flex-fill text-center text-dark border-end py-2"><i class="fa fa-bed me-2" style="color: #4b13f3;"></i>{{ $property->caracteristiques->number_rooms }} Chambres</small>
                    <small class="flex-fill text-center text-dark py-2"><i class="fa fa-bath me-2" style="color: #4b13f3;"></i>{{ $property->caracteristiques->number_salleBain }} Bain</small>
                    <small class="flex-fill text-center text-dark py-2"><i class="fa-solid fa-person-booth me-2" style="color: #4b13f3;"></i>{{ $property->caracteristiques->number_sallon }} Salon</small>
                    
                </div>
                <div class="btn d-flex  voirplus text-small text-white justify-content-center align-items-center text-center voirplusbutton    " style="padding:0px;">
                    <a href="{{ route('property.showDetail', $property->id) }}" class="text-decoration-none text-white"  >Voir plus <i class="fa-solid fa-eye" style=" margin-left:5px;"></i>    </a>
                </div>
               
              
            </div>

            
    </div>

   
    
    
@endforeach
@endif

</div>


                </div>
                <div class="row g-4 mt-2" id="new-properties"> 
                </div>
                 {{-- <div id="loading-indicator" class="text-center" style="display: none;">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading...</p>
                </div> --}}

                <div id="pagination-links" class="text-center">
                    <p>{{ $properties->links() }}</p>  
                  </div>
            </div>

        
        </div>
    </div>
</div>
@endsection

