<template>
  <div>

    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table" aria-hidden="true"></i> Create Group Government
        <a class="btn btn-primary pull-right" @click="back" role="button">Back</a>
      </div>

      <div class="card-body">
        <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
          <div class="form-row">
            <div class="col-sm mb-2">
              <validate tag="div">
                <input class="form-control" v-model="model.label" required autofocus name="label" type="text" placeholder="Label">

                <field-messages name="label" show="$invalid && $submitted" class="text-danger">
                  <small class="form-text text-success">Looks good!</small>
                  <small class="form-text text-danger" slot="required">Label is a required field</small>
                </field-messages>
              </validate>
            </div>

            <div class="col-sm mb-2">
              <validate tag="div">
                <input class="form-control" v-model="model.desciption" name="desciption" type="text" placeholder="Description">

                <field-messages name="desciption" show="$invalid && $submitted" class="text-danger">
                  <small class="form-text text-success">Looks good!</small>
                </field-messages>
              </validate>
            </div>

            <div class="col-auto mb-2">
              <button type="submit" class="btn btn-primary">Submit</button>

              <button type="reset" class="btn btn-effect-ripple btn-secondary reset_btn1" @click="form_reset">Reset</button>
            </div>
          </div>
        </vue-form>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  data () {
    return {
      formstate: {},
      model: {
        label: '',
        description: ''
      }
    }
  },
  methods: {
    form_reset() {
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
