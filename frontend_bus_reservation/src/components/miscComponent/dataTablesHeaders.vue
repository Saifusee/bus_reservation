<template>
    <v-card-title>
        <v-alert
        border="top"
        color="#ff4da6"
        dark

        >
        <h3>{{title}}</h3>
        </v-alert>
        <v-spacer></v-spacer>
        <v-text-field
        v-model="search"
        label="SEARCH ANY DETAIL HERE "
        single-line
        hide-details
        @keypress.enter="searchQueryRequest"
        ></v-text-field>      
        <v-btn
        class="mx-2"
        fab
        dark
        small
        color="indigo"
        @click="searchQueryRequest"
        >
        <v-icon dark>
        mdi-magnify
        </v-icon>
        </v-btn>
    </v-card-title>
</template>
<script>
import { eventBus } from './../../main'

export default {
    name: 'datatablesHeaders',

    props: [
        'pageTitle',
        'pageSource',
    ],

    data () {
        return {
            title: this.pageTitle,
            search: '',
        }
    },

    watch: {
        search (value) {
            if (value == '')
            {
            this.searchQueryRequest()
            }
        },
    },
    
    methods: {
        searchQueryRequest ()
        {
            let source = this.pageSource
            let sourceData = this.search

            switch (source)
            {
                case "allPartnerTravels":
                    eventBus.$emit('allPartnerTravels-search', sourceData);
                    break;

                case "allPickupPoint":
                    eventBus.$emit('allPickupPoint-search', sourceData);
                    break;

                case "allTickets":
                    eventBus.$emit('allTickets-search', sourceData);
                    break;
            }
        }
    },
}
</script>