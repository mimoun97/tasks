@extends('layouts.app')

@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex xs12>
                    <v-jumbotron>
                            <v-container fill-height>
                              <v-layout align-center>
                                <v-flex>
                                  <h3 class="display-3">Welcome to the site</h3>
                        
                                  <span class="subheading">Lorem ipsum dolor sit amet, pri veniam forensibus id. Vis maluisset molestiae id, ad semper lobortis cum. At impetus detraxit incorrupte usu, repudiare assueverit ex eum, ne nam essent vocent admodum.</span>
                        
                                  <v-divider class="my-3"></v-divider>
                        
                                  <div class="title mb-3">Check out our newest features!</div>
                        
                                  <v-btn
                                    class="mx-0"
                                    color="primary"
                                    large
                                  >
                                    See more
                                  </v-btn>
                                </v-flex>
                              </v-layout>
                            </v-container>
                          </v-jumbotron>
                <empty-state 
                    label="Crea la teva primera tasca!" 
                    icon="done" 
                    description="Si creeu una tasca, podreu afegir etiquetes i col·laborar amb les persones."
                    button="Crea">
                </empty-state>
            </v-flex>
            
        </v-layout>
    </container>
@endsection
