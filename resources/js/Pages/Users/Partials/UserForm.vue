<template>
    <div>
        <div v-if="$page.props.jetstream.canUpdateProfileInformation">
            <jet-form-section @submitted="updateProfileInformation">
                <template #title>
                    Profile Information
                </template>

                <template #description>
                    Create a new user.
                </template>

                <template #form>
                    <!-- Profile Photo -->
                    <template v-if="$page.props.jetstream.managesProfilePhotos">
                        <div class="col-span-6 sm:col-span-4">
                            <input type="file" class="hidden"
                                   ref="photo"
                                   @change="updatePhotoPreview">

                            <jet-label for="photo" value="Photo" />

                            <!-- Current Profile Photo -->
                            <div class="mt-2" v-show="! photoPreview">
                                <img :src="url" alt="Current Profile Photo" class="rounded-full h-20 w-20 object-cover">
                            </div>

                            <!-- New Profile Photo Preview -->
                            <div class="mt-2" v-show="photoPreview">
                                <span class="block rounded-full w-20 h-20"
                                      :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>

                            <jet-secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewPhoto">
                                Select A New Photo
                            </jet-secondary-button>

                            <jet-input-error :message="form.errors.photo" class="mt-2" />
                        </div>
                    </template>

                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="name" value="Name">
                            <required />
                        </jet-label>
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="email" value="Email" >
                            <required />
                        </jet-label>
                        <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                        <jet-input-error :message="form.errors.email" class="mt-2" />
                    </div>
                </template>

                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </jet-action-message>

                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </jet-button>
                </template>

            </jet-form-section>
        </div>

        <div v-if="$page.props.jetstream.canUpdatePassword">
            <jet-form-section @submitted="updateProfileInformation">
                <template #title>
                    Update Password
                </template>

                <template #description>
                    Ensure your account is using a long, random password to stay secure.
                </template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="password" value="Password" >
                            <required />
                        </jet-label>
                        <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" ref="password" autocomplete="password" />
                        <jet-input-error :message="form.errors.password" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="password_confirmation" value="Confirm Password" />
                        <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" autocomplete="new-password" />
                        <jet-input-error :message="form.errors.password_confirmation" class="mt-2" />
                    </div>
                </template>

                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </jet-action-message>

                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </jet-button>
                </template>
            </jet-form-section>
        </div>
    </div>

</template>

<script>
import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import Required from '@/Components/Required';

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        Required
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                name: '',
                email: '',
                photo: null,
                password: '',
                password_confirmation: '',
            }, {
                bag: 'updateProfileInformation',
            }),
            photoPreview: null,
            url: 'https://eu.ui-avatars.com/api/?background=EBF4FF&color=EBF4FF'
        }
    },
    methods: {
        updateProfileInformation() {
            let photo = this.$refs.photo;
            if (photo) {
                this.form.photo = photo.files[0]
            }
            this.form.post(route('user.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset();
                },
                onError: () => {
                    if (this.form.errors.password) {
                        this.form.reset('password', 'password_confirmation')
                        this.$refs.password.focus()
                    }
                }
            });
        },
        selectNewPhoto() {
            this.$refs.photo.click();
        },
        updatePhotoPreview() {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };
            reader.readAsDataURL(this.$refs.photo.files[0]);
        },
        deletePhoto() {
            this.$inertia.delete(route('current-user-photo.destroy'), {
                preserveScroll: true,
            }).then(() => {
                this.photoPreview = null
            });
        },
    },
}
</script>
