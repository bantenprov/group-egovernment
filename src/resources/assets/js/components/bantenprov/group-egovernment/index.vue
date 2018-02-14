<template>
  <div>
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table" aria-hidden="true"></i> Group Government

        <ul class="nav nav-pills card-header-pills pull-right">
          <li class="nav-item">
            <button class="btn btn-primary btn-sm" role="button" @click="create">Add</button>
          </li>
        </ul>
      </div>

      <div class="card-body">
		    <div class="d-flex justify-content-between align-items-center">
		      <vuetable-filter-bar></vuetable-filter-bar>
		    </div>

        <div style="margin:20px 0;">
          <div v-if="loading" class="d-flex justify-content-start align-items-center">
            <i class="fa fa-refresh fa-spin fa-fw"></i>
            <span>Loading...</span>
          </div>
        </div>

		    <vuetable ref="vuetable"
		      api-url="/api/group-egovernment"
		      :fields="fields"
		      :sort-order="sortOrder"
		      :css="css.table"
		      pagination-path=""
		      :per-page="5"
		      :append-params="moreParams"
		      @vuetable:pagination-data="onPaginationData"
		      @vuetable:loading="onLoading"
		      @vuetable:loaded="onLoaded">
		      <template slot="actions" slot-scope="props">
		        <div class="table-button-container pull-right">
              <!--<button class="btn btn-info btn-sm" role="button" @click="viewRow(props.rowData)">
                <span class="fa fa-eye"></span>
              </button>-->
              <button class="btn btn-warning btn-sm" role="button" @click="editRow(props.rowData)">
                <span class="fa fa-pencil"></span>
              </button>
		          <button class="btn btn-danger btn-sm" role="button" @click="deleteRow(props.rowData)">
		            <span class="fa fa-trash"></span>
		          </button>
		        </div>
		      </template>
		    </vuetable>

        <div class="d-flex justify-content-between align-items-center">
          <vuetable-pagination-info ref="paginationInfo"
          ></vuetable-pagination-info>
		      <vuetable-pagination ref="pagination"
            :css="css.pagination"
		        @vuetable-pagination:change-page="onChangePage">
		      </vuetable-pagination>
		    </div>
      </div>
    </div>
  </div>
</template>

<script>
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo';

export default {
  components: {
    VuetablePaginationInfo
  },
  data() {
    return {
      loading: true,
      fields: [
        '__sequence',
        {
          name: 'label',
          title: 'Label',
          sortField: 'label'
        },
        {
          name: 'description',
          title: 'Description',
          sortField: 'description'
        },
        '__slot:actions'
      ],
      sortOrder: [{
        field: 'label',
        direction: 'asc'
      }],
      moreParams: {},
      css: {
        table: {
          tableClass: 'table table-hover table-responsive-xl',
          ascendingIcon: 'fa fa-chevron-up',
          descendingIcon: 'fa fa-chevron-down'
        },
        pagination: {
          wrapperClass: 'vuetable-pagination btn-group ui basic segment grid',
          activeClass: 'active',
          disabledClass: 'disabled',
          pageClass: 'btn btn-light',
          linkClass: 'btn btn-light',
          icons: {
            first: 'fa fa-angle-double-left',
            prev: 'fa fa-angle-left',
            next: 'fa fa-angle-right',
            last: 'fa fa-angle-double-right'
          }
        }
      }
    }
  },
  methods: {
    onPaginationData(paginationData) {
      this.$refs.pagination.setPaginationData(paginationData);
      this.$refs.paginationInfo.setPaginationData(paginationData);
    },
    onChangePage(page) {
      this.$refs.vuetable.changePage(page);
    },
    create() {
        window.location = '#/admin/group-egovernment/create';
    },
    viewRow(rowData) {
      window.location = '#/admin/group-egovernment/' + rowData.id;
    },
    editRow(rowData) {
      window.location = '#/admin/group-egovernment/' + rowData.id + '/edit';
    },
    deleteRow(rowData) {
      let app = this;

      if (confirm('Do you really want to delete it?')) {
        axios.delete('/api/group-egovernment/' + rowData.id) 
          .then(function(response) {
            if (response.data.status == true) {
              app.$refs.vuetable.reload()
            } else {
              alert('Failed');
            }
          })
          .catch(function(response) {
            alert('Break');
          });
      }
    },
    onLoading: function() {
      this.loading = true;

      // console.log('Loading: ' + this.loading);
    },
    onLoaded: function() {
      this.loading = false;

      // console.log('Loading: ' + this.loading);
    }
  },
  events: {
    'filter-set' (filterText) {
      this.moreParams = {
        filter: filterText
      }

      Vue.nextTick(() => this.$refs.vuetable.refresh())
    },
    'filter-reset'() {
      this.moreParams = {}

      Vue.nextTick(() => this.$refs.vuetable.refresh())
    }
  }
}
</script>
