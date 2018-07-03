import container from 'container';

container(require.context('.', true, /^(?!.*admin).*\.(\w+)$/));
