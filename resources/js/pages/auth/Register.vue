<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogDescription } from '@/components/ui/dialog';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { vMaska } from 'maska/vue';
import { ref, watch } from 'vue';

const props = defineProps<{
    registrationSuccess?: boolean;
    protectedUrl?: string;
    status?: string | null;
    error_status?: string | null;
}>();

const dialogOpen = ref(false);
const copiedToClipboard = ref(false);

const copyToClipboard = () => {
    if (props.protectedUrl) {
        navigator.clipboard.writeText(props.protectedUrl);
        copiedToClipboard.value = true;
        setTimeout(() => {
            copiedToClipboard.value = false;
        }, 2000);
    }
};

watch(() => props.registrationSuccess, (newValue) => {
    if (newValue) {
        dialogOpen.value = true;
    }
}, { immediate: true });

const form = useForm({
    username: '',
    phone: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <AuthBase title="Create an account" description="Enter your details below to get link">
        <Head title="Register" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-success">
            {{ status }}
        </div>

        <div v-if="error_status" class="mb-4 text-center text-sm font-medium text-destructive">
            {{ error_status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">Username</Label>
                    <Input
                        id="name"
                        type="text"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="name"
                        v-model="form.username"
                        placeholder="Username"
                    />
                    <InputError :message="form.errors.username" />
                </div>

                <div class="grid gap-2">
                    <Label for="phone">Phonenumber</Label>
                    <Input id="phone" v-maska="'+380 (##) ###-##-##'" placeholder="+380 (00) 000-00-00" type="text" required :tabindex="2" autocomplete="phone" v-model="form.phone" />
                    <InputError :message="form.errors.phone" />
                </div>

                <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Create account
                </Button>
            </div>
        </form>

        <!-- Registration Success Dialog -->
        <Dialog :open="dialogOpen" @update:open="dialogOpen = $event">
            <DialogContent class="sm:max-w-md">
                <DialogHeader>
                    <DialogTitle>Registration Successful</DialogTitle>
                    <DialogDescription>
                        Your unique access link has been generated. Please copy this link - it will be valid for 7 days.
                    </DialogDescription>
                </DialogHeader>
                
                <div class="flex flex-col gap-4 py-4">
                    <div class="flex items-center space-x-2">
                        <div class="grid flex-1 gap-2">
                            <Label for="link" class="sr-only">Link</Label>
                            <Input
                                id="link"
                                readonly
                                :defaultValue="protectedUrl"
                                class="w-full"
                            />
                        </div>
                        <Button type="button" size="sm" @click="copyToClipboard" :disabled="copiedToClipboard">
                            <span v-if="!copiedToClipboard">Copy</span>
                            <span v-else>Copied!</span>
                        </Button>
                    </div>
                    
                    <p class="text-sm text-center text-muted-foreground">
                        Click the link to access your protected page.
                    </p>

                    <div class="flex justify-center">
                        <Link :href="protectedUrl" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full sm:w-auto">
                            Access Protected Page
                        </Link>
                    </div>
                </div>
            </DialogContent>
        </Dialog>
    </AuthBase>
</template>
