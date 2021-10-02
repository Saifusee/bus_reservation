<template>
    <v-dialog v-model="computeDeleteModalDisplay" max-width="500px">
        <v-card>
            <v-card-title class="text-h5">{{computeDeleteModalTitle}}</v-card-title>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="modalCancel">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="modalConfirm">Confirm</v-btn>
                <v-spacer></v-spacer>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import { mapGetters } from 'vuex'
import { eventBus } from '../../main'

export default {
    name: 'deleteModal',

    computed: {
        ...mapGetters (
            {
                computeDeleteModalDisplay: 'getterDeleteModalDisplay',
                computeDeleteModalTitle: 'getterDeleteModalTitle',
                computeDeleteModalData: 'getterDeleteModalData',
                computeDeleteModalSource: 'getterDeleteModalSource',
            }
        ),
    },

    methods: {

        modalCancel () {
          this.resetDeleteModalGlobalMixin(false, "", "", "") //Global Mixin
        },

        modalConfirm () {
            let source = this.computeDeleteModalSource
            let sourceData = this.computeDeleteModalData
            
            switch (source)
            {

                case "delete-all-partner-travels":
                    eventBus.$emit('event-delete-all-partner-travels', sourceData);
                        break;

                case "delete-all-pickup-point":
                    eventBus.$emit('event-delete-all-pickup-point', sourceData);
                        break;

                case "cancel-all-tickets":
                    eventBus.$emit('event-cancel-all-tickets', sourceData);
                        break;

                case "log-out":
                    eventBus.$emit('event-log-out', sourceData);
                        break;
            }
        }
    },
}
</script>