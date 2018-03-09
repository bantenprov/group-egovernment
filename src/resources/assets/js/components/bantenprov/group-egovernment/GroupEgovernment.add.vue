<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> {{ title }}

      <ul class="nav nav-pills card-header-pills pull-right">
        <li class="nav-item">
          <button class="btn btn-primary btn-sm" role="button" @click="back">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <vue-form :state="state" @submit.prevent="onSubmit">

        <validate tag="div">
          <div class="form-group row">
            <label for="model-label" class="col-sm-2 col-form-label">Label</label>

            <div class="col-sm-10">
              <input type="text" class="form-control" id="model-label" v-model="model.label" name="label" placeholder="Label" required autofocus>

              <field-messages name="label" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">This field is a required field</small>
              </field-messages>
            </div>
          </div>
        </validate>

        <validate tag="div">
          <div class="form-group row">
            <label for="model-description" class="col-sm-2 col-form-label">Description</label>

            <div class="col-sm-10">
              <input type="text" class="form-control" id="model-description" v-model="model.description" name="description" placeholder="Description" required autofocus>

              <field-messages name="description" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">This field is a required field</small>
              </field-messages>
            </div>
          </div>
        </validate>

        <div class="form-group row">
          <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-primary">Submit</button>

            <button type="reset" class="btn btn-secondary" @click="reset">Reset</button>
          </div>
        </div>

      </vue-form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      state: {},
      title : "Add Group Egovernment",
      model: {
        label: "",
        description: ""
      }
    }
  },
  mounted() {
    axios.get('api/group-egovernment/create')
      .then(response => {
        if (response.data.loaded == true) {
          this.model.label = response.data.group_egovernment.label;
          this.model.description = response.data.group_egovernment.description;
        } else {
          alert('Failed');
        }
      })
      .catch(function(response) {
        alert('Break');
        window.location.href = '#/admin/group-egovernment';
      });
  },
  methods: {
    onSubmit: function() {
      let app = this;

      if (this.state.$invalid) {
        return;
      } else {
        axios.post('api/group-egovernment', {
            label: this.model.label,
            description: this.model.description
          })
          .then(response => {
            if (response.data.loaded == true) {
              if(response.data.message == 'success'){
                alert(response.data.message);
                app.back();
              }else{
                alert(response.data.message);
              }
            } else {
              alert(response.data.message);
            }
          })
          .catch(function(response) {
            alert('Break ' + response.data.message);
          });
      }
    },
    reset() {
      this.model = {
        label: "",
        description: ""
      };
    },
    back() {
      window.location = '#/admin/group-egovernment';
    }
  }
}
</script>
